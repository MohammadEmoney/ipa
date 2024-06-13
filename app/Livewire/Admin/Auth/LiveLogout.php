<?php

namespace App\Livewire\Admin\Auth;

use Livewire\Component;

class LiveLogout extends Component
{
    public function render()
    {
        return view('livewire.admin.auth.live-logout');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->to(route('home'));
    }
}
