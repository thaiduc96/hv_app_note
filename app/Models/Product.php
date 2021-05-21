<?php

namespace App\Models;

use App\Traits\Filterable;
use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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

    protected $attributes = [
      'image_path',
      'image_thumbnail_path',
    ];


    public function getImagePathAttribute($value)
    {
        return Storage::disk('product')->url($this->image);
    }

    public function getImageThumbnailPathAttribute($value)
    {
        return Storage::disk('product')->url($this->image_thumbnail);
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
            })->withPivot('product_price', 'product_name', 'quantity');
    }
}
