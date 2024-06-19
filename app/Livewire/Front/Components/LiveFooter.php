<?php

namespace App\Livewire\Front\Components;

use App\Models\Post;
use App\Traits\LayoutTrait;
use Livewire\Component;

class LiveFooter extends Component
{
    use LayoutTrait;

    public function render()
    {
        $posts = Post::active()->lang()->latest()->take(3)->get();
        $layoutGroup = $this->getLayoutGroup(null,'main-menu');
        $menu = $this->getLayouts($layoutGroup);
        return view('livewire.front.components.live-footer', compact('posts', 'menu'));
    }
}
