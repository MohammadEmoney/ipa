<?php

namespace App\Livewire\Front\Components;

use App\Traits\LayoutTrait;
use Livewire\Component;

class LiveCallToAction extends Component
{
    use LayoutTrait;

    public function render()
    {
        $layoutGroup = $this->getLayoutGroup(null,'main-cta');
        $layout = $this->getLayouts($layoutGroup)?->first();
        return view('livewire.front.components.live-call-to-action', compact('layout', 'layoutGroup'));
    }
}
