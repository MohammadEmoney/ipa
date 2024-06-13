<?php

namespace App\Livewire\Admin\Components;

use Livewire\Component;

class LiveBreadcrumb extends Component
{
    public $items = [];

    public function render()
    {
        return view('livewire.admin.components.live-breadcrumb');
    }
}
