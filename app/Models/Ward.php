<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    use Filterable;

    protected $table = 'ward';
    protected $primaryKey = 'id';
    public $timestamps = false;


    protected $filterable = [
        'name',
        'type',
        'id',
        'district_id'
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
