<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Storage;

class ProductImage extends Base
{
    use Filterable;
    use SoftDeletes;

    protected $fillable = [
        'image',
        'image_thumbnail',
        'product_id',
    ];

    protected $filterable = [
        'product_id'
    ];

    protected $appends = array('image_path','image_thumbnail_path','href_delete');

    public function getHrefDeleteAttribute()
    {
        return route('admin.productImages.destroy',$this->id);
    }

    public function getImagePathAttribute()
    {
        return !empty($this->image) ? Storage::url($this->image) : null;
    }

    public function getImageThumbnailPathAttribute()
    {
        return !empty($this->image_thumbnail) ? Storage::url($this->image_thumbnail) : null;
    }


    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }
}
