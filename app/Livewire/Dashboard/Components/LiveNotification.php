<?php

namespace App\Livewire\Dashboard\Components;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LiveNotification extends Component
{

    public function readNotification()
    {
        $notification = Auth::user()->notifications->first();
        $slug = $notification->data['slug'] ?? null;
        if($slug){
            Auth::user()->unreadNotifications->markAsRead();
            return redirect()->to(route('user.circulars.show', ['circular' => $slug]));
        }
    }

    public function render()
    {
        $count = Auth::user()->unreadNotifications->count();
        return view('livewire.dashboard.components.live-notification', compact('count'));
    }
}
