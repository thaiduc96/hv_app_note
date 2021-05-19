<?php

namespace App\Repositories\Eloquents;

use App\Models\Config;
use App\Models\Shop;
use App\Repositories\Contracts\ShopContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class ShopRepositoryEloquent extends BaseRepositoryEloquent implements ShopContract
{
    public function getModel(): Model
    {
        return new Shop;
    }

    public function filter($conditions = [], $columns = ['*'], $query = null)
    {
        $query = $query ?? $this->model;
        if (!empty($param['latitude']) && !empty($param['latitude'])) {
            $query->from(DB::raw(DB::raw('(SELECT *, 111.111 * DEGREES(ACOS(LEAST(1.0, COS(RADIANS(latitude))
                                    * COS(RADIANS(' . $param['lat'] . '))
                                    * COS(RADIANS(longitude - ' . $param['lng'] . '))
                                    + SIN(RADIANS(latitude))
                                    * SIN(RADIANS(' . $param['lat'] . '))))) AS distance_in_km
                                     FROM shops) as shops')))
                ->orderBy('distance_in_km', 'ASC');
        }
        return parent::filter($conditions, $columns, $query);
    }
}
