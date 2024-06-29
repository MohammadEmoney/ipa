<?php

namespace App\Factories\LayoutFactories\Articles;

use App\Strategies\LayoutStrategies\Articles\BestSellingArticleStrategy;
use App\Strategies\LayoutStrategies\Articles\CategoryArticleStrategy;
use App\Strategies\LayoutStrategies\Articles\MostPopularArticleStrategy;
use App\Strategies\LayoutStrategies\Articles\MostVisitedArticleStrategy;
use App\Strategies\LayoutStrategies\Articles\NewestArticleStrategy;
use App\Strategies\LayoutStrategies\Articles\OldestArticleStrategy;
use App\Strategies\LayoutStrategies\Articles\RandomArticleStrategy;
use App\Strategies\LayoutStrategies\Articles\SelectArticleStrategy;
use App\Strategies\LayoutStrategies\Articles\TagArticleStrategy;

class ArticleStrategyFactory {
    public static function getStrategy($selectItem) {
        switch ($selectItem) {
            case 'select':
                return new SelectArticleStrategy();
            case 'newest':
                return new NewestArticleStrategy();
            case 'oldest':
                return new OldestArticleStrategy();
            case 'most_visited':
                return new MostVisitedArticleStrategy();
            case 'most_popular':
                return new MostPopularArticleStrategy();
            case 'random':
                return new RandomArticleStrategy();
            case 'bestselling':
                return new BestSellingArticleStrategy();
            case 'category':
                return new CategoryArticleStrategy();
            case 'tag':
                return new TagArticleStrategy();
            // Add other cases here
            default:
                return new SelectArticleStrategy(); // Handle default case
        }
    }
}
