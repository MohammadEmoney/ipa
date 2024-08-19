<?php

namespace App\Livewire\Dashboard\News;

use App\Models\Post;
use App\Traits\AlertLiveComponent;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class LiveNewsIndex extends Component
{
    use AlertLiveComponent, WithPagination;

    protected $listeners = [ 'destroy'];

    public $paginate = 8;
    public $sort = 'created_at';
    public $sortDirection = 'DESC';
    public $search;
    public $title;
    public $filter = [];

    public function mount()
    {
        $this->title = __('global.posts');
    }

    public function resetFilter()
    {
        $this->filter = [];
    }

    public function download($id)
    {
        if(Auth::user()->can('active_user')){
            $post = Post::query()->find($id);
            if($post->getFirstMedia('attachment'))
                return $post->getFirstMedia('attachment');
            $this->alert(__('messages.file_not_exists'))->error();
        }else{
            $this->alert(__('messages.not_have_access'))->error();
        }
    }

    public function show($slug)
    {
        return redirect()->to(route('user.news.show', ['slug' => $slug]));
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $posts = Post::query()->lang()->with(['media']);
        $search = trim($this->search);
        if($search && mb_strlen($search) > 2){
            $posts = $posts->where(function($query) use ($search){
                $query->where('title', "like", "%$search%")
                    ->orWhere('slug', "like", "%$search%");
                    // ->orWhere('description', "like", "%$search%")
                    // ->orWhere('summary', "like", "%$search%");
            });
        }
        $posts = $posts->orderBy($this->sort, $this->sortDirection)->paginate($this->paginate);
        return view('livewire.dashboard.news.live-news-index', compact('posts'))->extends('layouts.panel')->section('content');
    }
}
