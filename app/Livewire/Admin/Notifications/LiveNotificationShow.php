<?php

namespace App\Livewire\Admin\Notifications;

use App\Traits\AlertLiveComponent;
use Livewire\Component;

class LiveNotificationShow extends Component
{
    use AlertLiveComponent;

    public function mount()
    {
        $this->alert(__('messages.under_development'))->warning()->redirect('admin.dashboard');
    }

    public function render()
    {
        return view('livewire.admin.notifications.live-notification-show')
            ->extends('layouts.admin-panel')
            ->section('content');
    }
}
