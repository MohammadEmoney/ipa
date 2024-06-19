<?php

namespace App\Strategies\LayoutStrategies\Slider;

use App\Models\Category;
use App\Models\Page;
use App\Models\Product;
use App\Strategies\LayoutStrategies\SliderStrategy;

class PageSliderStrategy implements SliderStrategy
{
    public function handle($id) {
        $page = Page::find($id);
        return [
            'link' => route('front.pages.show', ['page' => $page->slug]),
            'title' => $page->title,
            'id' => $page->id,
            'slug' => $page->slug,
            'model' => $page
        ];
    }
}
