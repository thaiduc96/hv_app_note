<?php

namespace App\Models;

use App\Facades\OrderFacade;
use App\Helpers\AuthHelper;
use App\Repositories\Facades\OrderHistoryRepository;
use App\Repositories\Facades\ServiceProviderHistoryRepository;
use App\Traits\Filterable;
use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Order extends Base
{
    use Filterable;
    use SoftDeletes;

    const CODE_HEAD = 'ĐH';

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
    ];

    protected $casts = [
        'total' => 'double',
    ];

    const ARR_SAVE_HISTORY = [
        'delivery_time_from',
        'delivery_time_to',
        'status',
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

        static::updating(function ($model) {

            $str = '';
            foreach (self::ARR_SAVE_HISTORY as $column) {
                if ($model->$column != $model->getOriginal($column)) {
                    $str .= trans('validation.attributes.' . $column) . ' ' . $model->getOriginal($column) . ' -> ' . $model->$column . ". \n";
                }
            }
            if (!empty($str)) {
                OrderHistoryRepository::create([
                    'order_id' => $model->id,
                    'updated_by' => Auth::id(),
                    'content' => $str
                ]);
            }
        });
    }

    public function filterDeliveryTime($query, $value)
    {
        if (!empty($value)) {
            $rangeTime = explode('-',$value);
            $from = trim($rangeTime[0]) . ":00";
            $to = trim($rangeTime[1]) . ":00";
            return  $query->where(function ($q) use ($from, $to){
                return $q->where($this->getTable() . '.delivery_time_from' , '>=', $from)
                    ->where($this->getTable() . '.delivery_time_from' , '<=', $to);
            })->orWhere(function ($q) use ($to, $from){
                return $q->where($this->getTable() . '.delivery_time_to' , '>=', $from)
                    ->where($this->getTable() . '.delivery_time_to' , '<=', $to);
            });
        }
        return $query;
    }

    public function filterStatus($query, $value)
    {
        if (!empty($value)) {
            return $query->where($this->getTable() . '.status', $value );
        }
        return $query;
    }

    public function filterCode($query, $value)
    {
        if (!empty($value)) {
            return $query->where($this->getTable() . '.code', 'LIKE', "%" . $value . "%");
        }
        return $query;
    }

    public function filterReceiverName($query, $value)
    {
        if (!empty($value)) {
            return $query->where($this->getTable() . '.receiver_name', 'LIKE', "%" . $value . "%");
        }
        return $query;
    }

    public function filterReceiverPhone($query, $value)
    {
        if (!empty($value)) {
            return $query->where($this->getTable() . '.receiver_phone', 'LIKE', "%" . $value . "%");
        }
        return $query;
    }

    public function filterReceiverAddress($query, $value)
    {
        if (!empty($value)) {
            return $query->where($this->table . '.receiver_address', 'LIKE', "%" . $value . "%");
        }
        return $query;
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
            })->withPivot('product_price', 'product_name', 'quantity','total');
    }
}
