<?php

namespace App\Livewire\Admin\Roles;

use Livewire\Attributes\Title;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class LiveRoleIndex extends Component
{
    public function edit($roleId)
    {
        return redirect()->to(route('admin.roles.permissions', $roleId));
    }

    #[Title('لیست نقش های کاربران')]
    public function render()
    {
        $roles = Role::paginate();
        return view('livewire.admin.roles.live-role-index', compact('roles'))
            ->extends('layouts.admin-panel')
            ->section('content');
    }
}
