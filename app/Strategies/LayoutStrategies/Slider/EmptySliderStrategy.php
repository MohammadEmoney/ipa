<?php

namespace App\Strategies\LayoutStrategies\Slider;

use App\Strategies\LayoutStrategies\SliderStrategy;

class EmptySliderStrategy implements SliderStrategy
{
    public function handle($id) {
        return [
            'link' => null,
            'title' => "",
            'id' => "",
            'slug' => "",
            'model' => "",
        ];
    }
}
