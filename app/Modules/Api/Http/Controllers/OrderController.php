<?php

namespace App\Modules\Api\Http\Controllers;

use App\Facades\OrderFacade;
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
            $data = OrderFacade::find($data->id);
            DB::commit();
        } catch (\Exception $e){
            DB::rollBack();
            throw $e;
        }
        return $this->successResponse($data);
    }

    public function update($id, CreateOrderRequest $request){

        DB::beginTransaction();
        try {
            $data = OrderFacade::update($id,$request->all());
            $data = OrderFacade::find($data->id);
            DB::commit();
        } catch (\Exception $e){
            DB::rollBack();
            throw $e;
        }
        return $this->successResponse($data);
    }

    public function show($id){
        $data = OrderFacade::find($id);
        return $this->successResponse($data);

    }
}
