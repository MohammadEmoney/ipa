<?php

namespace App\Livewire\Dashboard\News;

use App\Models\Post;
use App\Traits\AlertLiveComponent;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class LiveNewsShow extends Component
{
    use AlertLiveComponent;
    use WithFileUploads;

    public $post;
    public $title;

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->title = $post->title;
    }

    public function download()
    {
        if(Auth::user()->can('active_user')){
            $post = $this->post;
            if($mediaItem = $post->getFirstMedia('attachment'))
                return $post->getFirstMedia('attachment');
            $this->alert(__('messages.file_not_exists'))->error();
        }else{
            $this->alert(__('messages.not_have_access'))->error();
        }
    }

    public function render()
    {
        return view('livewire.dashboard.news.live-news-show')->extends('layouts.panel')->section('content');
    }
}
