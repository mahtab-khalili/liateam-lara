<?php

namespace Domain\Product\Actions;

use Domain\Product\Models\Product;

class DeleteProductAction
{
    public static function execute(Product $product): void
    {
        $product->delete();
    }
}
