<?php

namespace App\Livewire\Admin\Roles;

use App\Traits\AlertLiveComponent;
use Illuminate\Http\Request;
use Livewire\Attributes\Title;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class LiveRolePermission extends Component
{
    use AlertLiveComponent;

    public $role;
    public $title;
    public $disabledCreate = true;
    public $selectedAll = [];
    public $selectedPermissions = [];
    public $allFalsePermissions = [];
    public $allTruePermissions = [];
    public $allAssignedPermissions = [];

    public function mount()
    {
        $this->title = __('global.role_permission_managment');

        $permissions = Permission::all();
        $this->allFalsePermissions = $permissions->pluck('id', 'id')->map(function ($item) {
            return false;
        })->toArray();
        $roles = Role::all();
        foreach($roles as $role){
            $rolePermissions = $role->permissions()->pluck('id', 'id')->map(function ($item) {
                return true;
            })->toArray();
            $meregedArray = $rolePermissions + $this->allFalsePermissions;
            $this->selectedPermissions[$role->id] = $meregedArray;
        }
        $this->allTruePermissions = $permissions->pluck('id', 'id')->map(function ($item) {
            return true;
        })->toArray();
        $this->allAssignedPermissions = $permissions->pluck('id', 'id')->map(function ($item) {
            return true;
        })->toArray();
    }

    public function selectAll($roleId)
    {
        if(isset($this->selectedAll[$roleId]) && $this->selectedAll[$roleId]){
            $this->selectedPermissions[$roleId] = $this->allTruePermissions;
        }else{
            $this->selectedPermissions[$roleId] = $this->allFalsePermissions;
        }
    }

    public function submit()
    {
        $filtredArray = array_filter($this->selectedPermissions);

        foreach($filtredArray as $role => $permissions){
            $role = Role::findOrFail($role);
            $permissions = collect($permissions)->map(function($value, $key){
                if($value)
                    return $key;
            })->filter();
            $role->syncPermissions($permissions);
        }

        $this->alert('دسترسی با موفقیت ویرایش شد.')->success();
    }

    // #[Title('مدیریت دسترسی نقش ها')]
    public function render()
    {
        $permissions = Permission::orderBy('name')->get();
        $roles = Role::all();
        return view('livewire.admin.roles.live-role-permission', compact('permissions', 'roles'))
            ->extends('layouts.admin-panel')
            ->section('content');
    }
}
