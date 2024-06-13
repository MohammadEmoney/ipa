<?php

namespace App\Strategies\LayoutStrategies\Menu;

use App\Models\Tag;
use App\Strategies\LayoutStrategies\MenuStrategy;

class TagMenuStrategy implements MenuStrategy
{
    public function handle($id) {
        $tag = Tag::where('id', $id)->with(['products' => function($query){
            $query->where('active', 1);
        }])->first();
        return [
            // 'link' => router('vitrin.tags.show', $tag->id),
            'link' => "#",
            'title' => $tag->title,
            'id' => $tag->id,
            'slug' => $tag->slug,
            'model' => $tag
        ];
    }
}
