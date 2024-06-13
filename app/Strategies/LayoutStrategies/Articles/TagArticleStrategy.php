<?php

namespace App\Strategies\LayoutStrategies\Articles;

use App\Enums\EnumCommentStatus;
use App\Models\Article;
use App\Strategies\LayoutStrategies\ArticleStrategy;

class TagArticleStrategy implements ArticleStrategy
{
    public function handle($id, $count) {
        return Article::whereRelation('tags', 'id',  $id)
        ->withCount(['comments' => fn($q) => $q->where('status', EnumCommentStatus::Allowed)])
        ->latest()
        ->take($count)
        ->get();
    }
}
