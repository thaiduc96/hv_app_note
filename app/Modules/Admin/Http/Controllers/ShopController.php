<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Helpers\UploadHelper;
use App\Http\Controllers\Controller;
use App\Models\Shop;
use App\Modules\Admin\Http\Requests\Shop\CreateShopRequest;
use App\Modules\Admin\Http\Requests\Shop\UpdateShopRequest;
use App\Repositories\Facades\ShopRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ShopController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = ShopRepository::datatables($request->all())->withTrashed();
            return DataTables::of($query)
                ->addColumn('action', function ($model) {
                    $arrBtn = [];
                    $arrBtn['edit'] = route('admin.shops.edit', $model->id);
                    if ($model->trashed()) {
                        $arrBtn['recovery'] = route('admin.shops.recovery', $model->id);
                    } else {
                        $arrBtn['delete'] = route('admin.shops.destroy', $model->id);
                    }
                    return view('Admin::layouts.components.group-button', $arrBtn);
                })
                ->editColumn('status', function ($model) {
                    return view("Admin::layouts.components.datatable-status", ['status' => $model->status]);
                })
                ->rawColumns(['status', 'image_thumbnail', 'action'])
                ->make(true);
        }
        return view('Admin::shops.index');
    }

    public function create()
    {
        $model = new Shop();
        return view('Admin::shops.create',compact('model'));
    }


    public function store(CreateShopRequest $request)
    {
        $data = $request->all();
        DB::beginTransaction();
        try {
            if(!empty($data['status']) && $data['status'] == 'on'){
                $data['status'] = STATUS_ACTIVE;
            }elsE{
                $data['status'] = STATUS_INACTIVE;
            }
            ShopRepository::create($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        return $this->successResponse(true);
    }

    public function edit($id)
    {
        $model = ShopRepository::findOrFail($id);
        return view('Admin::shops.create', compact('model'));
    }

    public function update(UpdateShopRequest $request, $id)
    {
        $model = ShopRepository::findOrFail($id);
        DB::beginTransaction();
        try {
            $data = $request->all();
            if(!empty($data['status']) && $data['status'] == 'on'){
                $data['status'] = STATUS_ACTIVE;
            }elsE{
                $data['status'] = STATUS_INACTIVE;
            }
            ShopRepository::update($model,$data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        return $this->successResponse(true);
    }

    public function destroy($id)
    {
        $model = ShopRepository::findOrFail($id);
        DB::beginTransaction();
        try {
            UploadHelper::delete($model->image);
            ShopRepository::delete($model);
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
            ShopRepository::recovery($id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;

        }
        return $this->successResponse(true);
    }

}
