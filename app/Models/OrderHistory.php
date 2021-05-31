<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderHistory extends Base
{
    use Filterable;
    use SoftDeletes;

    protected $fillable = [
        'content',
        'order_id',
        'admin_id',
    ];
}
