<?php

namespace Domain\Product\Models;

use Domain\Shared\Contracts\Database\MongoBaseModel;

class Product extends MongoBaseModel
{

    protected $fillable = [
        'name',
        'price',
        'inventory',
    ];
}