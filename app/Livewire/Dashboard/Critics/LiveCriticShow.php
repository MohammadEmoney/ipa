<?php

namespace App\Livewire\Dashboard\Critics;

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
    }

    public function render()
    {
        return view('livewire.dashboard.critics.live-critic-show')->extends('layouts.panel')->section('content');
    }
}
