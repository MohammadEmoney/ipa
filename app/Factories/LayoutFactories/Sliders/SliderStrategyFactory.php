<?php

namespace App\Factories\LayoutFactories\Sliders;

use App\Strategies\LayoutStrategies\Slider\CategorySliderStrategy;
use App\Strategies\LayoutStrategies\Slider\NoneSliderStrategy;
use App\Strategies\LayoutStrategies\Slider\PageSliderStrategy;
use App\Strategies\LayoutStrategies\Slider\StaticSliderStrategy;
use App\Strategies\LayoutStrategies\Slider\TagSliderStrategy;
use App\Strategies\LayoutStrategies\Products\SelectProductStrategy;

class SliderStrategyFactory {
    public static function getStrategy($selectItem) {
        switch ($selectItem) {
            case 'none':
                return new NoneSliderStrategy();
            case 'static':
                return new StaticSliderStrategy();
            case 'page':
                return new PageSliderStrategy();
            case 'category':
                return new CategorySliderStrategy();
            case 'tag':
                return new TagSliderStrategy();
            // Add other cases here
            default:
                return new NoneSliderStrategy(); // Handle default case
        }
    }
}
