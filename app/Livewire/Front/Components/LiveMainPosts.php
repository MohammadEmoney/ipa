<?php

namespace App\Livewire\Front\Components;

use App\Models\Post;
use App\Traits\LayoutTrait;
use Livewire\Component;

class LiveMainPosts extends Component
{
    use LayoutTrait;

    public function render()
    {
        // $posts = Post::active()->lang()->take(3)->get();
        $layoutGroup = $this->getLayoutGroup(null,'main-news');
        $layouts = $this->getLayouts($layoutGroup);
        return view('livewire.front.components.live-main-posts', compact('layouts'));
    }
}
