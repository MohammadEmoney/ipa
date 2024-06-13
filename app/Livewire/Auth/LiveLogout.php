<?php

namespace App\Livewire\Auth;

use Livewire\Component;

class LiveLogout extends Component
{
    public function render()
    {
        return view('livewire.auth.live-logout');
    }

    public function logout()
    {
        auth()->logout();
        return redirect(route('home'));
    }
}
