<?php

namespace App\Strategies\LayoutStrategies\Products;

use App\Enums\EnumCommentStatus;
use App\Models\Product;
use App\Strategies\LayoutStrategies\ProductStrategy;

class OldestProductStrategy implements ProductStrategy
{
    public function handle($id, $count) {
        return Product::oldest()
        ->withCount(['comments' => fn($q) => $q->where('status', EnumCommentStatus::Allowed)])
        ->with('wishlists')
        ->take($count)
        ->get();
    }
}
