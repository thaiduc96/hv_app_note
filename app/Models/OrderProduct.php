<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderProduct extends Base
{
    use Filterable;
    use SoftDeletes;

    protected $fillable = [
        'product_price',
        'product_name',
        'quantity',
    ];


    protected $casts = [
        'product_price' => 'double',
        'quantity' => 'integer',
    ];

}
