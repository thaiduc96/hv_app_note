<?php

namespace App\Modules\Api\Http\Controllers;

use App\Facades\OrderFacade;
use App\Helpers\AuthHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\CreateOrderRequest;
use App\Repositories\Facades\OrderRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(Request $request){

        $key = OrderRepository::filter($request->all());
        return $this->successResponse($key);
    }

    public function create(CreateOrderRequest $request){

        DB::beginTransaction();
        try {
            $data = OrderFacade::create($request->all());
            DB::commit();
        } catch (\Exception $e){
            DB::rollBack();
            throw $e;
        }
        return $this->successResponse($data);
    }
}
