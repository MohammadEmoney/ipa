<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use App\Traits\AlertLiveComponent;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class LiveDeletedUsers extends Component
{
    use AlertLiveComponent, WithPagination;

    protected $listeners = [ 'destroy', 'deleteAll'];

    public $title;
    public $paginate = 10;
    public $sort = 'created_at';
    public $sortDirection = 'DESC';
    public $search;

    public function mount()
    {
        $this->title = __('global.deleted_users_list');
    }

    public function show($id)
    {
        return redirect()->to(route('admin.users.show', ['user' => $id]));
    }

    public function deleteAll()
    {
        if(auth()->user()->can('user_delete')){
            $users = User::query()->onlyTrashed()->get();
            foreach($users as $user){
                if ($user) {
                    $user->clearMediaCollection('avatar');
                    $user->userInfo()?->delete();
                    $user->syncRoles([]);
                    $user->forceDelete();
                    $this->alert(__('messages.user_deleted'))->success();
                }
                else{
                    $this->alert(__('messages.user_not_deleted'))->error();
                }
            }
        }else{
            $this->alert(__('messages.not_have_access'))->error();
        }
    }

    public function destroy($id)
    {
        if(auth()->user()->can('user_delete')){
            $user = User::query()->withTrashed()->find($id);

            if ($user) {
                try {
                    DB::beginTransaction();
                    DB::statement('SET FOREIGN_KEY_CHECKS=0');
                    $user->clearMediaCollection('avatar');
                    $user->clearMediaCollection('nationalCard');
                    $user->clearMediaCollection('license');
                    $user->clearMediaCollection('bankReceipt');
                    $user->userInfo()?->delete();
                    $user->transactions()?->delete();
                    foreach($user->orders as $order)
                        $order?->clearMediaCollection('bankReceipt');
                    $user->orders()?->delete();
                    $user->syncRoles([]);
                    $user->forceDelete();
                    DB::statement('SET FOREIGN_KEY_CHECKS=1');
                    DB::commit();
                    $this->alert(__('messages.user_deleted'))->success();
                    return redirect()->to(route('admin.users.trash'));
                } catch (Exception $e) {
                    $this->alert($e->getMessage())->error();
                }
            }
            else{
                $this->alert(__('messages.user_not_deleted'))->error();
            }
        }else{
            $this->alert(__('messages.not_have_access'))->error();
        }
    }

    public function edit($id)
    {
        return redirect()->to(route('admin.users.edit', ['user' => $id]));
    }

    public function render()
    {
        $users = User::query()->onlyTrashed()->with(['userInfo']);
            if($this->search && mb_strlen($this->search) > 2){
                $users = $users->where(function($query){
                    $query->where('first_name', "like", "%$this->search%")
                        ->orWhere('last_name', "like", "%$this->search%")
                        ->orWhere('email', "like", "%$this->search%")
                        ->orWhereHas('userInfo', function($query) {
                            $query->where('phone_1', 'like', "%$this->search%")
                            ->orWhere('phone_2', "like", "%$this->search%")
                            ->orWhere('landline_phone', "like", "%$this->search%");
                        });
                });
            }
        $users = $users->orderBy($this->sort, $this->sortDirection)->paginate($this->paginate);
        return view('livewire.admin.users.live-deleted-users', compact('users'))->extends('layouts.admin-panel')->section('content');
    }
}
