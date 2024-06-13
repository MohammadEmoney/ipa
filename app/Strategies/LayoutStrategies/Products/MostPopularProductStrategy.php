<?php

namespace App\Strategies\LayoutStrategies\Products;

use App\Enums\EnumCommentStatus;
use App\Models\Product;
use App\Strategies\LayoutStrategies\ProductStrategy;

class MostPopularProductStrategy implements ProductStrategy
{
    public function handle($id, $count) {
        return Product::withCount('wishlists')
        ->withCount(['comments' => fn($q) => $q->where('status', EnumCommentStatus::Allowed)])
        ->with('wishlists')
        ->orderBy('wishlists_count', 'DESC')
        ->take($count)
        ->get();
    }
}
