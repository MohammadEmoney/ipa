<?php

namespace App\Strategies\LayoutStrategies\Products;

use App\Enums\EnumCommentStatus;
use App\Models\Product;
use App\Strategies\LayoutStrategies\ProductStrategy;

class DiscountProductStrategy implements ProductStrategy
{
    public function handle($id, $count) {
        return Product::selectRaw('*, CASE
            WHEN discount_type = "prices" THEN (discount_value / sales_price) * 100
            WHEN discount_type = "percent" THEN discount_value
            END as discount_amount')
            ->orderBy('discount_amount', 'DESC')
            ->with('wishlists')
            ->withCount(['comments' => fn($q) => $q->where('status', EnumCommentStatus::Allowed)])
            ->take($count)->get();
    }
}
