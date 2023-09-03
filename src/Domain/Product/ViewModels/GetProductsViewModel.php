<?php

namespace Domain\Product\ViewModels;

use Domain\Product\Models\Product;

class GetProductsViewModel
{
    public function products()
    {
        $items = Product::get()->toArray();
        return $items;
            
    }

    public function total(): int
    {
        return Product::count();
    }
}