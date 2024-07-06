<?php

namespace App\Livewire\Admin\Critics;

use App\Enums\EnumCriticStatus;
use App\Models\Critic;
use App\Traits\AlertLiveComponent;
use Livewire\Component;

class LiveCriticShow extends Component
{
    use AlertLiveComponent;

    public $title;
    public $critic;
    public $data = [];

    public function mount(Critic $critic)
    {
        $this->critic = $critic;
        $this->title = $critic->title;
        $critic->update(['status' => EnumCriticStatus::READ]);
    }

    public function render()
    {
        return view('livewire.admin.critics.live-critic-show')->extends('layouts.admin-panel')->section('content');
    }
}
