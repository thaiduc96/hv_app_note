<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use Filterable;

    protected $table = 'district';
    public $timestamps  = false;

    protected $filterable = [
        'name',
        'type',
        'id',
        'province_id'
    ];

    public function filterName($query, $value)
    {
        return $query->where($this->table . '.name', 'LIKE', "%" . $value . "%");
    }

    public function filterType($query, $value)
    {
        return $query->where($this->table . '.type', 'LIKE', "%" . $value . "%");
    }
}
