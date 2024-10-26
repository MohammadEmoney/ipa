<?php

namespace App\Livewire\Admin\Notifications;

use App\Traits\AlertLiveComponent;
use App\Traits\NotificationTrait;
use Livewire\Component;

class LiveSendPremadeMessages extends Component
{
    use AlertLiveComponent, NotificationTrait;

    public $data = [];
    public $title;

    public function mount()
    {
        $this->title = __('global.premade_notifications');
    }

    public function sendMessage($type)
    {
        if($type === "completedProfile")
            $this->completedProfile();
        if($type === "notCompletedProfile")
            $this->notCompletedProfile();
        if($type === "membershipFirstWarning")
            $this->membershipFirstWarning();
        if($type === "membershipSecondWarning")
            $this->membershipSecondWarning();

        return $this->alert(__('messages.messages_sent_success'))->success();
    }

    public function render()
    {
        return view('livewire.admin.notifications.live-send-premade-messages')->extends('layouts.admin-panel')->section('content');
    }
}
