<?php

namespace App\Livewire\Front\Components;

use Livewire\Component;

class LiveBreadcrumb extends Component
{
    public $items = [];
    public $title;
    public $subTitle;
    public $background;

    public function render()
    {
        return view('livewire.front.components.live-breadcrumb');
    }
}
