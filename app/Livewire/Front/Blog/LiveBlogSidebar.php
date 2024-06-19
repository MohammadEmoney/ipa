<?php

namespace App\Livewire\Front\Blog;

use App\Models\Category;
use App\Models\Post;
use Livewire\Component;

class LiveBlogSidebar extends Component
{
    public $search;
    public $searchResult = [];

    public function updated()
    {
        $posts = Post::query()->with(['categories', 'mainCategory']);
        $search = trim($this->search);
        if($search && mb_strlen($search) > 2){
            $posts = $posts->where(function($query) use ($search){
                $query->where('title', "like", "%$search%")
                    ->orWhere('slug', "like", "%$search%");
                    // ->orWhere('description', "like", "%$search%")
                    // ->orWhere('summary', "like", "%$search%");
            });
        }
        $posts = $posts->take(3)->get();
        $this->searchResult = $posts;
    }

    public function submitSearch()
    {
        return redirect()->to(route('front.search', ['search' => $this->search]));
    }

    public function render()
    {
        $categories = Category::active()->lang()->whereIsRoot()->orderBy('title')->withCount(['posts' => function($query){
            $query->lang();
        }])->get();
        $recentPosts = Post::active()->lang()->latest()->with('media')->get();
        return view('livewire.front.blog.live-blog-sidebar', compact('categories', 'recentPosts'));
    }
}
