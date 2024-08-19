<?php

namespace App\Livewire\Front\Components;

use Livewire\Component;

class LiveBreadcrumb extends Component
{
    public $items = [];
    public $title;
    public $subTitle;
    public $background;

    public function mount($title = null, $items = null, $subTitle = null, $background = null)
    {
        $this->title = $title;
        $this->items = $items;
        $this->subTitle = $subTitle;
        $this->background = $background;
    }

    public function render()
    {
        return view('livewire.front.components.live-breadcrumb');
    }
}
