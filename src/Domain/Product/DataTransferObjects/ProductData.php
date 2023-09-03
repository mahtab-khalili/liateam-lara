<?php

namespace Domain\Product\DataTransferObjects;

use Spatie\LaravelData\Data;

class ProductData extends Data
{

    public function __construct(
        public readonly ?string $name,
        public readonly ?int $price,
        public readonly ?int $inventory

    ){}

    // public static function fromRequest(Request $request): self
    // {
    //     return self::from([
    //         ...$request->all()
    //     ]);
    // }

    // public static function fromModel(Product $product): self
    // {
    //     return self::from([
    //         ...$product->toArray()
    //     ]);
    // }

    // public static function rules(): array
    // {
    //     return [
    //         'name' => ['required', 'string'],
    //         'price' => ['required', 'int'],
    //         'inventory' => ['required', 'int'],
    //     ];
    // }
}