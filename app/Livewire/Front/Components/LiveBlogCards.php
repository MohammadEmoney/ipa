<?php

namespace App\Livewire\Front\Components;

use App\Models\Post;
use Livewire\Component;

class LiveBlogCards extends Component
{
    public function render()
    {
        $posts = Post::active()->lang()->latest()->take(3)->get();
        return view('livewire.front.components.live-blog-cards', compact('posts'));
    }
}
