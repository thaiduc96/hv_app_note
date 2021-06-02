<?php

namespace App\Repositories\Contracts;

interface ProductImageContract extends BaseContract
{
    public function updateProductId($ids,$productId);
}
