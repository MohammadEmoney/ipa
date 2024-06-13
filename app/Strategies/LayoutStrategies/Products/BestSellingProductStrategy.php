<?php

namespace App\Strategies\LayoutStrategies\Products;

use App\Enums\EnumCommentStatus;
use App\Models\Product;
use App\Strategies\LayoutStrategies\ProductStrategy;

class BestSellingProductStrategy implements ProductStrategy
{
    public function handle($id, $count) {
        return Product::withCount(['orderItems' => function($query){
            $query->where('status_id', '!=', 1);
        }])->withCount(['comments' => fn($q) => $q->where('status', EnumCommentStatus::Allowed)])
        ->with('wishlists')->orderBy('order_items_count', 'DESC')->take($count)->get();
    }
}
