<?php

namespace App\Strategies\LayoutStrategies\Slider;

use App\Strategies\LayoutStrategies\SliderStrategy;

class NoneSliderStrategy implements SliderStrategy
{
    public function handle($id) {
        return [
            'link' => "#",
            'title' => "",
            'id' => "",
            'slug' => "",
            'model' => "",
        ];
    }
}
