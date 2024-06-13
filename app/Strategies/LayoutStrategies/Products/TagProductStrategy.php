<?php

namespace App\Strategies\LayoutStrategies\Products;

use App\Enums\EnumCommentStatus;
use App\Models\Product;
use App\Strategies\LayoutStrategies\ProductStrategy;

class TagProductStrategy implements ProductStrategy
{
    public function handle($id, $count) {
        return Product::whereRelation('tags', 'id',  $id)
        ->withCount(['comments' => fn($q) => $q->where('status', EnumCommentStatus::Allowed)])
        ->with('wishlists')
        ->latest()
        ->take($count)
        ->get();
    }
}
