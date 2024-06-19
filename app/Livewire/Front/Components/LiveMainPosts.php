<?php

namespace App\Livewire\Front\Components;

use App\Models\Post;
use Livewire\Component;

class LiveMainPosts extends Component
{
    public function render()
    {
        $posts = Post::active()->lang()->take(3)->get();
        return view('livewire.front.components.live-main-posts', compact('posts'));
    }
}
