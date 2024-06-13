<?php

namespace App\Strategies\LayoutStrategies\Menu;

use App\Models\Category;
use App\Models\Product;
use App\Strategies\LayoutStrategies\MenuStrategy;

class NoneMenuStrategy implements MenuStrategy
{
    public function handle($id) {
        return [
            'link' => "#",
            'title' => "",
            'id' => "",
            'slug' => "",
            'model' => "",
        ];
    }
}
