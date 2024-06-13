<?php

namespace App\Strategies\LayoutStrategies\Articles;

use App\Enums\EnumCommentStatus;
use App\Models\Article;
use App\Strategies\LayoutStrategies\ArticleStrategy;

class OldestArticleStrategy implements ArticleStrategy
{
    public function handle($id, $count) {
        return Article::oldest()
        ->withCount(['comments' => fn($q) => $q->where('status', EnumCommentStatus::Allowed)])
        ->take($count)
        ->get();
    }
}
