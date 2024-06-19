<?php

namespace App\Livewire\Front\Blog;

use App\Models\Post;
use Livewire\Component;

class LiveBlogShow extends Component
{
    public $post;
    public $title;

    public function mount(Post $post)
    {
        $this->post = $post->load(['mainCategory', 'createdBy', 'media']);
        $this->title = $post->title;
    }

    public function render()
    {
        return view('livewire.front.blog.live-blog-show')
            ->extends('layouts.front')->section('content');
    }
}
