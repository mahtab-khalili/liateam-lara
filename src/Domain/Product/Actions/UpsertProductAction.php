<?php

namespace Domain\Product\Actions;

use Domain\Product\DataTransferObjects\ProductData;
use Domain\Product\Models\Product;

class UpsertProductAction
{
    public static function execute(ProductData $data, Product $product = null): Product
    {
        return Product::updateOrCreate(
            [
                '_id' => $product?->_id,
            ],
            [
                ...$data->all()
            ],
        );

    }
}
