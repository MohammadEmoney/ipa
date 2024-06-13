<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use App\Traits\AlertLiveComponent;
use Livewire\Component;
use Livewire\WithPagination;

class LiveDeletedUsers extends Component
{
    use AlertLiveComponent, WithPagination;

    protected $listeners = [ 'destroy', 'deleteAll'];

    public $type;
    public $paginate = 10;
    public $sort = 'created_at';
    public $sortDirection = 'DESC';
    public $search;

    public function show($id)
    {
        return redirect()->to(route('admin.users.' . $this->type .'.show', $id));
    }

    public function deleteAll()
    {
        if(auth()->user()->can('user_delete')){
            $users = User::query()->onlyTrashed()->get();
            foreach($users as $user){
                if ($user) {
                    $user->clearMediaCollection('national_card');
                    $user->clearMediaCollection('personal_image');
                    $user->clearMediaCollection('id_first_page');
                    $user->clearMediaCollection('id_second_page');
                    $user->clearMediaCollection('document_1');
                    $user->clearMediaCollection('document_2');
                    $user->clearMediaCollection('document_3');
                    $user->clearMediaCollection('document_4');
                    $user->clearMediaCollection('document_5');
                    $user->clearMediaCollection('document_6');
                    $user->clearMediaCollection('document_7');
                    $user->clearMediaCollection('document_8');
                    $user->userInfo()?->delete();
                    $user->syncRoles([]);
                    $user->jobReferences()?->delete();
                    $user->forceDelete();
                    $this->alert('کاربر حذف شد')->success();
                }
                else{
                    $this->alert('کاربر حذف نشد')->error();
                }
            }
        }else{
            $this->alert('شما اجازه دسترسی به این بخش را ندارید.')->error();
        }
    }

    public function destroy($id)
    {
        if(auth()->user()->can('user_delete')){
            $user = User::query()->withTrashed()->find($id);

            if ($user) {
                $user->clearMediaCollection('national_card');
                $user->clearMediaCollection('personal_image');
                $user->clearMediaCollection('id_first_page');
                $user->clearMediaCollection('id_second_page');
                $user->clearMediaCollection('document_1');
                $user->clearMediaCollection('document_2');
                $user->clearMediaCollection('document_3');
                $user->clearMediaCollection('document_4');
                $user->clearMediaCollection('document_5');
                $user->clearMediaCollection('document_6');
                $user->clearMediaCollection('document_7');
                $user->clearMediaCollection('document_8');
                $user->userInfo()?->delete();
                $user->syncRoles([]);
                $user->jobReferences()?->delete();
                $user->forceDelete();
                $this->alert('کاربر حذف شد')->success();
                return redirect()->to(route('admin.users.trash'));
            }
            else{
                $this->alert('کاربر حذف نشد')->error();
            }
        }else{
            $this->alert('شما اجازه دسترسی به این بخش را ندارید.')->error();
        }
    }

    public function edit($id)
    {
        return redirect()->to(route('admin.users.'. $this->type .'.edit', $id));
    }

    public function render()
    {
        $users = User::query()->onlyTrashed()->with(['userInfo']);
            if($this->search && mb_strlen($this->search) > 2){
                $users = $users->where(function($query){
                    $query->where('first_name', "like", "%$this->search%")
                        ->orWhere('last_name', "like", "%$this->search%")
                        ->orWhere('email', "like", "%$this->search%")
                        ->orWhere('national_code', "like", "%$this->search%")
                        ->orWhereHas('userInfo', function($query) {
                            $query->where('mobile_1', 'like', "%$this->search%")
                            ->orWhere('mobile_2', "like", "%$this->search%")
                            ->orWhere('landline_phone', "like", "%$this->search%");
                        });
                });
            }
        $users = $users->orderBy($this->sort, $this->sortDirection)->paginate($this->paginate);
        return view('livewire.admin.users.live-deleted-users', compact('users'))->extends('layouts.admin-panel')->section('content');
    }
}
