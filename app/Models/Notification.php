<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Notification extends Base
{
    use SoftDeletes;
    use Filterable;

    protected $fillable = [
        'image',
        'image_thumbnail',
        'title',
        'body',
        'short_body',
        'created_by',
        'sent_by',
        'is_sent',
    ];

    protected $casts = [
        'is_sent' => 'boolean'
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->created_by = Auth::id();
            if ($model->is_sent) {
                $model->sent_by = Auth::id();
            }
        });

        static::updating(function ($model) {
            if ($model->is_sent) {
                $model->sent_by = Auth::id();
            }
        });
    }

    public function notificationUsers(): HasMany
    {
        return $this->hasMany(NotificationUser::class, 'notification_id');
    }

}
