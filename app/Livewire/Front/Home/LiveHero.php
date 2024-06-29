<?php

namespace App\Livewire\Front\Home;

use App\Traits\LayoutTrait;
use Livewire\Component;

class LiveHero extends Component
{
    use LayoutTrait;

    public function render()
    {
        $layoutGroup = $this->getLayoutGroup(null,'main-slider');
        $sliders = $this->getLayouts($layoutGroup);
        return view('livewire.front.home.live-hero', compact('sliders'));
    }
}
