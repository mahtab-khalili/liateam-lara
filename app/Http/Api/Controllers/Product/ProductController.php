<?php

namespace App\Http\Api\Controllers\Product;

use App\Http\Api\Controllers\Controller;
use Domain\Product\DataTransferObjects\ProductData;
use Domain\Product\Actions\UpsertProductAction;
use Domain\Product\Actions\DeleteProductAction;
use Domain\Product\Models\Product;
use Illuminate\Http\Request;
use Domain\Product\ViewModels\GetProductsViewModel;
use Domain\Product\ViewModels\GetProductViewModel;

class ProductController extends Controller
{

    public function index()
    {
        return responseApi(
            'success',
            null,
            [new GetProductsViewModel()]
        );
    }

    public function create(ProductData $data)
    {
        $product = UpsertProductAction::execute($data);

        return responseApi(
            'success',
            trans('product.create_successfully'),
            [
                'product' => $product
            ]
        );
    }

    public function update(ProductData $data, Product $product)
    {
        $product = UpsertProductAction::execute($data, $product);

        return responseApi(
            'success',
            trans('product.update_successfully'),
            [
                'product' => $product
            ]
        );
    }

    public function show(Product $product)
    {
        return responseApi(
            'success',
            null,
            ['product' => $product->toArray()]
        );
    }

    public function delete(Product $product)
    {
        DeleteProductAction::execute($product);

        return responseApi(
            'success',
            trans('delete_was_successful'),
        );
    }

}