<?php

namespace App\Strategies\LayoutStrategies\Articles;

use App\Enums\EnumCommentStatus;
use App\Models\Article;
use App\Strategies\LayoutStrategies\ArticleStrategy;

class NewestArticleStrategy implements ArticleStrategy
{
    public function handle($id, $count) {
        return Article::latest()->withCount(['comments' => fn($q) => $q->where('status', EnumCommentStatus::Allowed)])->take($count)->get();
    }
}
