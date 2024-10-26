<?php

namespace App\Livewire\Admin\Users;

use App\Enums\EnumUserSituation;
use App\Enums\EnumUserType;
use App\Filters\FilterManager;
use App\Models\User;
use App\Traits\AlertLiveComponent;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;

class LiveUserIndex extends Component
{
    use AlertLiveComponent, WithPagination; //, FilterTrait;

    protected $listeners = [ 'destroy'];

    public $paginate = 10;
    public $sort = 'created_at';
    public $sortDirection = 'DESC';
    public $search;
    public $title;

    public $filters = [
        'name' => null,
        'phone' => null,
        'email' => null,
        'type' => null,
        'situation' => null,
        'airline' => null,
        'active' => null,
        'register_start' => null,
        'register_end' => null,
    ];

    public function mount()
    {
        $this->title = __('global.users');
    }

    public function show($id)
    {
        return redirect()->to(route('admin.users.show', ['user' => $id]));
    }

    public function create()
    {
        return redirect()->to(route('admin.users.create'));
    }

    public function destroy($id)
    {
        if(auth()->user()->can('user_delete')){
            $user = User::query()->find($id);

            if ($user) {
                $user->delete();
                $this->alert(__('messages.user_deleted'))->success();
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

    public function changeActiveStatus($id)
    {
        $user = User::find($id);
        if($user){
            $user->update(['is_active' => !$user->is_active]);
            $permission = Permission::findByName('active_user');
            if ($user->hasPermissionTo($permission)) {
                $user->revokePermissionTo($permission);
            } else {
                $user->givePermissionTo($permission);
            }
            $this->alert(__('messages.updated_successfully'))->success();
        }
    }

    public function resetFilter()
    {
        $this->filters = [];
    }

    public function updatedFilters()
    {
        $this->resetPage();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $users = (new FilterManager(new User))->apply($this->filters);
        // $users = User::query()->with(['userInfo']);
        $search = trim($this->search);
        if($search && mb_strlen($search) > 2){
            $users = $users->where(function($query) use ($search){
                $query->where('first_name', "like", "%$search%")
                    ->orWhere('last_name', "like", "%$search%")
                    ->orWhere('email', "like", "%$search%")
                    ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%$search%"])
                    ->orWhereHas('userInfo', function($query) use ($search) {
                        $query->where('phone_1', 'like', "%$search%")
                        ->orWhere('phone_2', "like", "%$search%")
                        ->orWhere('landline_phone', "like", "%$search%");
                    });
            });
        }
        // if($situation = data_get($this->filters, 'situation')){
        //     $users = $users->whereRelation('userInfo', 'situation', $situation);
        // }
        $users = $users->orderBy($this->sort, $this->sortDirection)->paginate($this->paginate);
        $situations = EnumUserSituation::getTranslatedAll();
        $types = EnumUserType::getTranslatedAll();
        return view('livewire.admin.users.live-user-index', compact('users', 'situations', 'types'))->extends('layouts.admin-panel')->section('content');
    }
}
