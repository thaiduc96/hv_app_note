<?php

namespace App\Services;

use App\Helpers\AuthHelper;
use App\Helpers\CodeHelper;
use App\Models\Order;
use App\Repositories\Facades\OrderRepository;
use App\Repositories\Facades\ProductRepository;

class OrderService
{
    public function create($input)
    {
        if (AuthHelper::getGuardApi()->check()) {
            $input['user_id'] = AuthHelper::getUserApiId();
        }
        return $this->handleOrder($input);
    }

    public function update($id, $input)
    {
        return $this->handleOrder($input, $id);
    }

    private function handleOrder($input, $orderId = null)
    {
        $arrProductId = array_column($input['products'], 'product_id');
        $products = ProductRepository::filter([
            'product_ids' => $arrProductId
        ]);

        $arr = [];
        $total = 0;
        foreach ($input['products'] as $inputProduct) {
            $product = $products->find($inputProduct['product_id']);
            $totalItem = $product['price'] * $inputProduct['quantity'];
            $arr[$product['id']] = [
                'product_price' => $product['price'],
                'product_name' => $product['name'],
                'quantity' => $inputProduct['quantity'],
                'total' => $totalItem
            ];
            $total += $totalItem;
        }
        $input['total'] = $total;
        $order = $orderId ? OrderRepository::update($orderId, $input) : OrderRepository::create($input);

        if (!empty($arr)) {
            $order->products()->sync($arr);
        }
        return $order;
    }

    public function find($id)
    {
        $data = OrderRepository::with(['products'])->findOrFail($id);
        return $data;
    }

    public function getNextCode()
    {
        $maxNumber = Order::max('code_number');
        if (empty($maxNumber)) {
            $maxNumber = 0;
        }
        $maxNumber = $maxNumber + 1;

        $code = CodeHelper::fullNumberWithLeadingZero($maxNumber);
        return [
            'code' => Order::CODE_HEAD. $code,
            'code_number' => $maxNumber
        ];
    }
}
