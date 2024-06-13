<?php

namespace App\Strategies\LayoutStrategies\Slider;

use App\Models\Category;
use App\Models\Product;
use App\Strategies\LayoutStrategies\SliderStrategy;

class StaticSliderStrategy implements SliderStrategy
{
    public function handle($id) {
        return [
            'link' => $id,
            'title' => "",
            'id' => "",
            'slug' => "",
            'model' => "",
        ];
    }
}
