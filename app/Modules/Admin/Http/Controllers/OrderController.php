<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Helpers\UploadHelper;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Modules\Admin\Http\Requests\Order\CreateOrderRequest;
use App\Modules\Admin\Http\Requests\Order\UpdateOrderRequest;
use App\Repositories\Facades\OrderRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = OrderRepository::datatables($request->all())->withTrashed();
            return DataTables::of($query)
                ->addColumn('action', function ($model) {
                    $arrBtn = [];
                    $arrBtn['edit'] = route('admin.orders.edit', $model->id);
                    if ($model->trashed()) {
                        $arrBtn['recovery'] = route('admin.orders.recovery', $model->id);
                    } else {
                        $arrBtn['delete'] = route('admin.orders.destroy', $model->id);
                    }
                    return view('Admin::layouts.components.group-button', $arrBtn);
                })
                ->editColumn('status', function ($model) {
                    return view("Admin::layouts.components.datatable-status", ['status' => $model->status]);
                })->editColumn('total', function ($model) {
                    return number_format($model->total);
                })
                ->addColumn('delivery_range_time', function ($model) {
                    return view('Admin::layouts.components.order.delivery-range-time', ['order' => $model]);
                })
                ->addColumn('receiver_info', function ($model) {
                    $name = $model->receiver_name ?? '';
                    $phone = $model->receiver_phone ?? '';
                    $address = $model->receiver_address ?? '';
                    return view('Admin::layouts.components.order.receiver-info', compact('name', 'phone', 'address'));
                })
                ->rawColumns(['status', 'receiver_info', 'action'])
                ->make(true);
        }
        return view('Admin::orders.index');
    }

    public function create()
    {
        $model = new Order();
        return view('Admin::orders.create', compact('model'));
    }


    public function store(CreateOrderRequest $request)
    {
        $data = $request->all();
        DB::beginTransaction();
        try {
            if (!empty($data['status']) && $data['status'] == 'on') {
                $data['status'] = STATUS_ACTIVE;
            } else {
                $data['status'] = STATUS_INACTIVE;
            }
            OrderRepository::create($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        return $this->successResponse(true);
    }

    public function edit($id)
    {
        $model = OrderRepository::with(['products'])->findOrFail($id);
        return view('Admin::orders.create', compact('model'));
    }

    public function update(UpdateOrderRequest $request, $id)
    {
        $model = OrderRepository::findOrFail($id);
        DB::beginTransaction();
        try {
            $data = $request->all();
            if (!empty($data['status']) && $data['status'] == 'on') {
                $data['status'] = STATUS_ACTIVE;
            } else {
                $data['status'] = STATUS_INACTIVE;
            }
            OrderRepository::update($model, $data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        return $this->successResponse(true);
    }

    public function destroy($id)
    {
        $model = OrderRepository::findOrFail($id);
        DB::beginTransaction();
        try {
            UploadHelper::delete($model->image);
            OrderRepository::delete($model);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        return $this->successResponse(true);
    }

    public function recovery($id)
    {
        DB::beginTransaction();
        try {
            OrderRepository::recovery($id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;

        }
        return $this->successResponse(true);
    }

    public function updatePatch($id, Request $request)
    {
        DB::beginTransaction();
        try {
            OrderRepository::update($id, $request->all());
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        return $this->successResponse(true);
    }

}
