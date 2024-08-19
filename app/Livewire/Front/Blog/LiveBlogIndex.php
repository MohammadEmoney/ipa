<?php

namespace App\Livewire\Front\Blog;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;

class LiveBlogIndex extends Component
{
    use WithPagination;

    public $paginate = 9;
    public $sort = 'created_at';
    public $sortDirection = 'DESC';
    public $search;
    public $title;
    public $filter = [];

    public function mount(Request $request)
    {
        $data = Validator::make($request->all(), [
            'search' => 'nullable|string|max:255',
        ]);

        if (!$data->fails()) {
            $this->search = $request->search;
        }
    }

    public function render()
    {
        $posts = Post::query()->active()->public()->lang()->with(['categories', 'mainCategory', 'createdBy']);
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
        return view('livewire.front.blog.live-blog-index', compact('posts'))
            ->extends('layouts.front')->section('content');
    }
}
