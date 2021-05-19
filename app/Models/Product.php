<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Storage;
class Product extends Model
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

    public function getImageAttribute($value){
        return Storage::disk('product')->url($value);
    }
}
