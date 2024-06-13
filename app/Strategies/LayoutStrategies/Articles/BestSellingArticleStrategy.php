<?php

namespace App\Strategies\LayoutStrategies\Articles;

use App\Enums\EnumCommentStatus;
use App\Models\Article;
use App\Strategies\LayoutStrategies\ArticleStrategy;

class BestSellingArticleStrategy implements ArticleStrategy
{
    public function handle($id, $count) {
        return Article::withCount(['orderItems' => function($query){
            $query->where('status_id', '!=', 1);
        }])
        ->withCount(['comments' => fn($q) => $q->where('status', EnumCommentStatus::Allowed)])
        ->orderBy('order_items_count', 'DESC')
        ->take($count)
        ->get();
    }
}
