<?php

namespace Domain\Shared\Contracts\Database;

use MongoDB\Laravel\Eloquent\Model as BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MongoBaseModel extends BaseModel 
{
    use HasFactory;
 
    protected $connection = 'mongodb';

}