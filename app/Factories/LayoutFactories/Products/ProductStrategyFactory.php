<?php

namespace App\Factories\LayoutFactories\Products;

use App\Strategies\LayoutStrategies\Products\BestSellingProductStrategy;
use App\Strategies\LayoutStrategies\Products\CategoryProductStrategy;
use App\Strategies\LayoutStrategies\Products\DiscountProductStrategy;
use App\Strategies\LayoutStrategies\Products\MostPopularProductStrategy;
use App\Strategies\LayoutStrategies\Products\MostVisitedProductStrategy;
use App\Strategies\LayoutStrategies\Products\NewestProductStrategy;
use App\Strategies\LayoutStrategies\Products\OldestProductStrategy;
use App\Strategies\LayoutStrategies\Products\RandomProductStrategy;
use App\Strategies\LayoutStrategies\Products\SelectProductStrategy;
use App\Strategies\LayoutStrategies\Products\TagProductStrategy;

class ProductStrategyFactory {
    public static function getStrategy($selectItem) {
        switch ($selectItem) {
            case 'select':
                return new SelectProductStrategy();
            case 'newest':
                return new NewestProductStrategy();
            case 'oldest':
                return new OldestProductStrategy();
            case 'most_visited':
                return new MostVisitedProductStrategy();
            case 'most_popular':
                return new MostPopularProductStrategy();
            case 'random':
                return new RandomProductStrategy();
            case 'bestselling':
                return new BestSellingProductStrategy();
            case 'discount':
                return new DiscountProductStrategy();
            case 'category':
                return new CategoryProductStrategy();
            case 'tag':
                return new TagProductStrategy();
            // Add other cases here
            default:
                return new SelectProductStrategy(); // Handle default case
        }
    }
}
