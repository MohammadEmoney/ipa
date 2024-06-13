<?php

namespace App\Strategies\LayoutStrategies\Articles;

use App\Enums\EnumCommentStatus;
use App\Models\Article;
use App\Strategies\LayoutStrategies\ArticleStrategy;

class MostVisitedArticleStrategy implements ArticleStrategy
{
    public function handle($id, $count) {
        return Article::orderBy('views', 'DESC')->withCount(['comments' => fn($q) => $q->where('status', EnumCommentStatus::Allowed)])->take($count)->get();
    }
}
