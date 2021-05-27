<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shop extends Base
{
    use Filterable;
    use SoftDeletes;

    protected $fillable = [
        'address',
        'zalo_phone',
        'latitude',
        'longitude',
        'status',
    ];
    protected $filterable = [
        'status',
    ];

    protected $casts = [
        'latitude' => 'double',
        'longitude' => 'double',
    ];

    public function filterAddress($query, $value){
        return $query->where($this->table.'.address','LIKE', "%".$value."%");
    }

    public function filterZaloPhone($query, $value){
        return $query->where($this->table.'.zalo_phone','LIKE', "%".$value."%");
    }

}
