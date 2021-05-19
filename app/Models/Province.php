<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use Filterable;

    protected $table = 'province';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $filterable = [
        'name',
        'type',
        'id'
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
