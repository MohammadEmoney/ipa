<?php

namespace App\Strategies\LayoutStrategies\Products;

use App\Enums\EnumCommentStatus;
use App\Models\Product;
use App\Strategies\LayoutStrategies\ProductStrategy;

class SelectProductStrategy implements ProductStrategy
{
    public function handle($id, $count) {
        return Product::find($id)->loadCount(['comments' => fn($q) => $q->where('status', EnumCommentStatus::Allowed)]);
    }
}
