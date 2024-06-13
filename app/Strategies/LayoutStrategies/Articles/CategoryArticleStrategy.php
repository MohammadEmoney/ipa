<?php

namespace App\Strategies\LayoutStrategies\Articles;

use App\Enums\EnumCommentStatus;
use App\Models\Article;
use App\Strategies\LayoutStrategies\ArticleStrategy;

class CategoryArticleStrategy implements ArticleStrategy
{
    public function handle($id, $count = 10) {
        return Article::whereRelation('categories', 'id',  $id)
        ->withCount(['comments' => fn($q) => $q->where('status', EnumCommentStatus::Allowed)])
        ->latest()
        ->take($count)
        ->get();
    }
}
