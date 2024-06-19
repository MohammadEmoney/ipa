<?php

namespace App\Livewire\Front\Categories;

use App\Models\Category;
use App\Models\Post;
use Livewire\Component;

class LiveCategoryShow extends Component
{
    public $category;

    public function mount(Category $category)
    {
        $this->category = $category->load(['posts' => function($query){
            $query;
        }]);
    }
    public function render()
    {
        $posts = Post::active()->where('lang', 'en')->whereRelation('categories', 'id',$this->category->id)->latest()->paginate();
        return view('livewire.front.categories.live-category-show', compact('posts'))
            ->extends('layouts.front')->section('content');
    }
}
