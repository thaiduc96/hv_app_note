<?php

namespace App\Services;

use App\Repositories\Facades\OrderRepository;

class OrderService
{
    public function create($input)
    {
        $order = OrderRepository::create($input);
        foreach($input['products'] as $product){

        }
    }
}
