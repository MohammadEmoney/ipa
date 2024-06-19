<?php

namespace App\Livewire\Front\Components;

use App\Traits\LayoutTrait;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class LiveMainMenu extends Component
{
    use LayoutTrait;
    
    public function render()
    {
        // $menus = Cache::rememberForever('main-menu', function () {
        //     $layoutGroup = $this->getLayoutGroup(null,'main-menu');
        //     return $this->getLayouts($layoutGroup);
        // });
        $layoutGroup = $this->getLayoutGroup(null,'main-menu');
        $menu = $this->getLayouts($layoutGroup);
        return view('livewire.front.components.live-main-menu', compact('menu'));
    }
}
