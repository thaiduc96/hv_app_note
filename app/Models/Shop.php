<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shop extends Base
{
    use Filterable;
    use SoftDeletes;

    protected $fillable = [
        'address',
        'zalo_phone',
        'latitude',
        'longitude',
        'status',
    ];
    protected $filterable = [
        'code',
        'target',
        'status',
    ];

    protected $casts = [
        'latitude' => 'double',
        'longitude' => 'double',
    ];

}
