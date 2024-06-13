<?php

namespace App\Strategies\LayoutStrategies\Articles;

use App\Enums\EnumCommentStatus;
use App\Models\Article;
use App\Strategies\LayoutStrategies\ArticleStrategy;

class SelectArticleStrategy implements ArticleStrategy
{
    public function handle($id, $count) {
        return Article::find($id)->loadCount(['comments' => fn($q) => $q->where('status', EnumCommentStatus::Allowed)]);
    }
}
