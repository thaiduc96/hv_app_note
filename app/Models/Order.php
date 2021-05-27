<?php

namespace App\Models;

use App\Facades\OrderFacade;
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

    CONST CODE_HEAD = 'OD';

    const STATUS_PENDING = 'pending';
    const STATUS_COMPLETE = 'complete';
    const STATUS_CANCEL = 'cancel';

    public static function listStatus()
    {
        return [
            self::STATUS_PENDING => 'Đang xử lý',
            self::STATUS_COMPLETE => 'Hoàn thành',
            self::STATUS_CANCEL => 'Huỷ',
        ];
    }

    protected $fillable = [
        'code',
        'code_number',
        'receiver_address',
        'receiver_name',
        'receiver_phone',
        'note',
        'status',
        'user_id',
        'device_token',
        'delivery_time_from',
        'delivery_time_to',
        'total'
    ];
    protected $filterable = [
        'user_id',
        'device_token',
        'status',
    ];

    protected $casts = [
        'total' => 'double',
    ];


    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->status = self::STATUS_PENDING;

            $nextCode = OrderFacade::getNextCode();
            $model->code = $nextCode['code'];
            $model->code_number = $nextCode['code_number'];
        });
    }

    public function filterCode($query, $value){
        return $query->where($this->table.'.code','LIKE', "%".$value."%");
    }

    public function filterReceiverName($query, $value){
        return $query->where($this->table.'.receiver_name','LIKE', "%".$value."%");
    }

    public function filterReceiverPhone($query, $value){
        return $query->where($this->table.'.receiver_phone','LIKE', "%".$value."%");
    }
    public function filterReceiverAddress($query, $value){
        return $query->where($this->table.'.receiver_address','LIKE', "%".$value."%");
    }



    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function deviceToken(): BelongsTo
    {
        return $this->belongsTo(DeviceToken::class, 'device_token_id', 'id');
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'order_products', 'order_id', 'product_id')
            ->using(new class extends Pivot {
                use UuidTrait;
            })->withPivot('product_price', 'product_name', 'quantity');
    }
}
