<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Storage;
class NotificationUser extends Base
{
    use SoftDeletes;
    use Filterable;

    protected $fillable = [
        'image',
        'image_thumbnail',
        'title',
        'body',
        'short_body',
        'read_at',
        'resource_id',
        'resource_table',
        'notification_id',
        'user_id',
        'device_token_id',
    ];

    protected $appends = array('image_path','image_thumbnail_path');

    protected $filterable = [
          'user_id',
          'notification_id',
    ];

    public function getImagePathAttribute()
    {
        return !empty($this->image) ? Storage::url($this->image) : null;
    }

    public function getImageThumbnailPathAttribute()
    {
        return !empty($this->image_thumbnail) ? Storage::url($this->image_thumbnail) : null;
    }

    public function deviceToken(): BelongsTo
    {
        return $this->belongsTo(DeviceToken::class,'device_token_id','id');
    }
}
