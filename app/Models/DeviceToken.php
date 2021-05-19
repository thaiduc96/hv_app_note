<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class DeviceToken extends Base
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'device_type',
        'device_token',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
