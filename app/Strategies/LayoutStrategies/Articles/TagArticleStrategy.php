<?php

namespace App\Strategies\LayoutStrategies\Articles;

use App\Enums\EnumCommentStatus;
use App\Models\Post;
use App\Strategies\LayoutStrategies\ArticleStrategy;

class TagArticleStrategy implements ArticleStrategy
{
    public function handle($id, $count) {
        return Post::whereRelation('tags', 'id',  $id)
        ->withCount(['comments' => fn($q) => $q->where('status', EnumCommentStatus::ALLOWED)])
        ->latest()
        ->take($count)
        ->get();
    }
}
