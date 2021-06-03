<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Helpers\UploadHelper;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Modules\Admin\Http\Requests\Product\CreateNotificationRequest;
use App\Modules\Admin\Http\Requests\Product\UpdateNotificationRequest;
use App\Repositories\Facades\ProductImageRepository;
use App\Repositories\Facades\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = ProductRepository::datatables($request->all())->withTrashed();
            return DataTables::of($query)
                ->addColumn('action', function ($model) {
                    $arrBtn = [];

                    $arrBtn['edit'] = route('admin.products.edit', $model->id);
                    if ($model->trashed()) {
                        $arrBtn['recovery'] = route('admin.products.recovery', $model->id);
                    } else {
                        $arrBtn['delete'] = route('admin.products.destroy', $model->id);
                    }
                    return view('Admin::layouts.components.group-button', $arrBtn);
                })
                ->editColumn('status', function ($model) {
                    return view("Admin::layouts.components.datatable-status", ['status' => $model->status]);
                })
                ->editColumn('image', function ($model) {
                    return view("Admin::layouts.components.image-datatables", ['url' => $model->image]);
                })
                ->rawColumns(['status', 'image_thumbnail', 'action'])
                ->make(true);
        }
        return view('Admin::products.index');
    }

    public function create()
    {
        $model = new Product();
        return view('Admin::products.create', compact('model'));
    }


    public function store(CreateNotificationRequest $request)
    {
        $data = $request->all();
        DB::beginTransaction();
        try {
            $path = UploadHelper::uploadFromRequest('image', config('uploadpath.product'));
            $data['image'] = $path;
            if (!empty($data['status']) && $data['status'] == 'on') {
                $data['status'] = STATUS_ACTIVE;
            } else {
                $data['status'] = STATUS_INACTIVE;
            }
            $data = ProductRepository::create($data);
            dd($request->productImages);
            if (!empty($request->productImages)) {
                ProductImageRepository::updateProductId($request->productImages,$data->id);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        return $this->successResponse(true);
    }

    public function edit($id)
    {
        $model = ProductRepository::findOrFail($id);
        return view('Admin::products.create', compact('model'));
    }

    public function update(UpdateNotificationRequest $request, $id)
    {
        $model = ProductRepository::findOrFail($id);
        DB::beginTransaction();
        try {
            $data = $request->all();
            if (!empty($request->image)) {
                $path = UploadHelper::uploadFromRequest('image', config('uploadpath.product'));
                $oldImage = $model->image;
                $data['image'] = $path;
            }

            if (!empty($data['status']) && $data['status'] == 'on') {
                $data['status'] = STATUS_ACTIVE;
            } else {
                $data['status'] = STATUS_INACTIVE;
            }
            ProductRepository::update($model, $data);
            if (!empty($request->productImages)) {
                ProductImageRepository::updateProductId($request->productImages,$model->id);
            }

            if(!empty($oldImage)){
                UploadHelper::delete($oldImage);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        return $this->successResponse(true);
    }

    public function destroy($id)
    {
        $model = ProductRepository::findOrFail($id);
        DB::beginTransaction();
        try {
            UploadHelper::delete($model->image);
            ProductRepository::delete($model);
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
            ProductRepository::recovery($id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;

        }
        return $this->successResponse(true);
    }

}
