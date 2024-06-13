<?php

namespace App\Livewire\Front\Home;

use Livewire\Component;

class LiveHome extends Component
{
    public function render()
    {
        return view('livewire.front.home.live-home')
            ->extends('layouts.front')->section('content');
    }
}
