<?php

namespace App\Livewire\Dashboard\Components;

use Livewire\Component;

class LiveBreadcrumb extends Component
{
    public $items = [];

    public function render()
    {
        return view('livewire.dashboard.components.live-breadcrumb');
    }
}
