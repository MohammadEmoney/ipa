<?php

namespace App\Strategies\LayoutStrategies\Articles;

use App\Enums\EnumCommentStatus;
use App\Models\Post;
use App\Strategies\LayoutStrategies\ArticleStrategy;

class BestSellingArticleStrategy implements ArticleStrategy
{
    public function handle($id, $count) {
        return Post::withCount(['orderItems' => function($query){
            $query->where('status_id', '!=', 1);
        }])
        ->withCount(['comments' => fn($q) => $q->where('status', EnumCommentStatus::ALLOWED)])
        ->orderBy('order_items_count', 'DESC')
        ->take($count)
        ->get();
    }
}
