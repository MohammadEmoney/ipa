<?php

namespace App\Strategies\LayoutStrategies\Articles;

use App\Enums\EnumCommentStatus;
use App\Models\Post;
use App\Strategies\LayoutStrategies\ArticleStrategy;

class MostVisitedArticleStrategy implements ArticleStrategy
{
    public function handle($id, $count) {
        return Post::orderBy('views', 'DESC')->withCount(['comments' => fn($q) => $q->where('status', EnumCommentStatus::ALLOWED)])->take($count)->get();
    }
}
