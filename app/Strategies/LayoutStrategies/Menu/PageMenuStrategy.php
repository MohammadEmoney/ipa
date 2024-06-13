<?php

namespace App\Strategies\LayoutStrategies\Menu;

use App\Models\Category;
use App\Models\Page;
use App\Models\Product;
use App\Strategies\LayoutStrategies\MenuStrategy;

class PageMenuStrategy implements MenuStrategy
{
    public function handle($id) {
        $page = Page::find($id);
        return [
            'link' => router('vitrin.pages.show', ['page' => $page->slug]),
            'title' => $page->title,
            'id' => $page->id,
            'slug' => $page->slug,
            'model' => $page
        ];
    }
}
