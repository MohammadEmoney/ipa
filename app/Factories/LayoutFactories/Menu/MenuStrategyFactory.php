<?php

namespace App\Factories\LayoutFactories\Menu;

use App\Strategies\LayoutStrategies\Menu\CategoryMenuStrategy;
use App\Strategies\LayoutStrategies\Menu\NoneMenuStrategy;
use App\Strategies\LayoutStrategies\Menu\PageMenuStrategy;
use App\Strategies\LayoutStrategies\Menu\StaticMenuStrategy;
use App\Strategies\LayoutStrategies\Menu\TagMenuStrategy;
use App\Strategies\LayoutStrategies\Products\SelectProductStrategy;

class MenuStrategyFactory {
    public static function getStrategy($selectItem) {
        switch ($selectItem) {
            case 'none':
                return new NoneMenuStrategy();
            case 'static':
                return new StaticMenuStrategy();
            case 'page':
                return new PageMenuStrategy();
            case 'category':
                return new CategoryMenuStrategy();
            case 'tag':
                return new TagMenuStrategy();
            // Add other cases here
            default:
                return new NoneMenuStrategy(); // Handle default case
        }
    }
}
