<?php

namespace App\Models;

use App\Traits\Filterable;
use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;
use Storage;

class Product extends Base
{
    use Filterable;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'price',
        'image',
        'status',
        'image_thumbnail',
        'description',
    ];
    protected $filterable = [
        'name',
        'price',
    ];

    protected $casts = [
        'price' => 'double'
    ];

    protected $appends = array('image_path','image_thumbnail_path');

    public function getImagePathAttribute()
    {
        return !empty($this->image) ? Storage::url($this->image) : null;
    }

    public function getImageThumbnailPathAttribute()
    {
        return !empty($this->image_thumbnail) ? Storage::url($this->image_thumbnail) : null;
    }

    public function filterName($query, $value){
        return $query->where($this->table.'.name','LIKE', "%".$value."%");
    }


    public function filterProductIds($query, $value)
    {
        return $query->whereIn($this->getTable() . '.id', $value);
    }


    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class, 'order_products', 'product_id', 'order_id')
            ->using(new class extends Pivot {
                use UuidTrait;
            })->withPivot('product_price', 'product_name', 'quantity','total');
    }

    public function productImages(): HasMany
    {
        return $this->hasMany(ProductImage::class,'product_id','id');
    }
}
