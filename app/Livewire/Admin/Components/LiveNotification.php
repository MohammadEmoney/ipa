<?php

namespace App\Livewire\Admin\Components;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LiveNotification extends Component
{
    public function readNotification()
    {
        $notification = Auth::user()->notifications->first();
        $id = $notification->data['id'] ?? null;
        if($id){
            Auth::user()->unreadNotifications->markAsRead();
            return redirect()->to(route('admin.orders.index', ['order' => $id]));
        }
    }

    public function render()
    {
        $count = Auth::user()->unreadNotifications->count();
        return view('livewire.admin.components.live-notification', compact('count'));
    }
}
