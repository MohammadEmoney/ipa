<?php

namespace App\Strategies\LayoutStrategies\Articles;

use App\Enums\EnumCommentStatus;
use App\Models\Article;
use App\Strategies\LayoutStrategies\ArticleStrategy;

class MostPopularArticleStrategy implements ArticleStrategy
{
    public function handle($id, $count) {
        return Article::withCount('wishlists')
        ->withCount(['comments' => fn($q) => $q->where('status', EnumCommentStatus::Allowed)])
        ->orderBy('wishlists_count', 'DESC')
        ->take($count)
        ->get();
    }
}
