<?php

namespace App\Models;

use App\Traits\Filterable;
use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Base
{
    use Filterable;
    use SoftDeletes;


    protected $fillable = [
        'receiver_address',
        'receiver_name',
        'receiver_phone',
        'note',
        'status',
        'user_id',
        'device_token',
    ];
    protected $filterable = [
        'user_id',
        'device_token',
        'status',
    ];

    protected $casts = [
        'price' => 'double'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function deviceToken(): BelongsTo
    {
        return $this->belongsTo(DeviceToken::class,'device_token_id','id');
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'order_products', 'order_id', 'product_id')
            ->using(new class extends Pivot {
                use UuidTrait;
            })->withPivot('product_price', 'product_name', 'quantity');
    }
}