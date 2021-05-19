<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserForgotPassword extends Base
{
    use Filterable;
    use SoftDeletes;

    protected $fillable = [
        'code',
        'target',
        'sending_method',
        'user_id',
        'expired_at',
    ];
    protected $filterable = [
        'code',
        'target'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->expired_at = now()->addMinutes(15);
        });
    }
}
