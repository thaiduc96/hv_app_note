<?php

namespace App\Repositories\Eloquents;

use App\Models\ProductImage;
use App\Repositories\Contracts\ProductImageContract;
use Illuminate\Database\Eloquent\Model;


class ProductImageRepositoryEloquent extends BaseRepositoryEloquent implements ProductImageContract
{
    public function getModel(): Model
    {
        return new ProductImage;
    }

    public function updateProductId($ids,$productId){
        $ids = is_string($ids) ? explode(',',$ids) : $ids;
        return $this->model->whereIn('id', $ids)->update([
           'product_id' => $productId
        ]);
    }
}
