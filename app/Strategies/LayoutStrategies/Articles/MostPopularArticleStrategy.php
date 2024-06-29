<?php

namespace App\Strategies\LayoutStrategies\Articles;

use App\Enums\EnumCommentStatus;
use App\Models\Post;
use App\Strategies\LayoutStrategies\ArticleStrategy;

class MostPopularArticleStrategy implements ArticleStrategy
{
    public function handle($id, $count) {
        return Post::withCount('wishlists')
        ->withCount(['comments' => fn($q) => $q->where('status', EnumCommentStatus::ALLOWED)])
        ->orderBy('wishlists_count', 'DESC')
        ->take($count)
        ->get();
    }
}
