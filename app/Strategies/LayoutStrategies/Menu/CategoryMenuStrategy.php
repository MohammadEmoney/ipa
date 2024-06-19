<?php

namespace App\Strategies\LayoutStrategies\Menu;

use App\Models\Category;
use App\Models\Product;
use App\Strategies\LayoutStrategies\MenuStrategy;

class CategoryMenuStrategy implements MenuStrategy
{
    public function handle($id) {
        $category = Category::where('id', $id)->with(['children' => function($query){
            $query->where('active', 1);
        }])->first();
        return [
            'link' => $category ? route('front.categories.show', ['category' => $category->slug]) : "#",
            'title' => $category->title,
            'id' => $category->id,
            'slug' => $category->slug,
            'model' => $category
        ];
    }
}
