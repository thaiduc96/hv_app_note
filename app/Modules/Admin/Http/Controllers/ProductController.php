<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Helpers\UploadHelper;
use App\Http\Controllers\Controller;
use App\Modules\Admin\Http\Requests\Product\CreateProductRequest;
use App\Modules\Admin\Http\Requests\Product\UpdateProductRequest;
use App\Repositories\Facades\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
                ->editColumn('image_thumbnail', function ($model) {
                    return view("Admin::layouts.components.image-datatables", ['url' => $model->image_thumbnail]);
                })
                ->rawColumns(['status', 'image_thumbnail', 'action'])
                ->make(true);
        }
        return view('Admin::products.index');
    }

    public function create()
    {
        return view('Admin::products.create');
    }


    public function store(CreateProductRequest $request)
    {
        $data = $request->all();
        DB::beginTransaction();
        try {
            $path = UploadHelper::uploadFromRequest('image', config('uploadpath.product'));
            $data['image'] = $path;
            ProductRepository::create($data);
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
        return view('Admin::banners.edit', compact('model'));
    }

    public function update(UpdateProductRequest $request, $id)
    {
        $data = $request->all();
        DB::beginTransaction();
        try {
            $path = UploadHelper::uploadFromRequest('image', config('uploadpath.product'));
            $data['image'] = $path;
            ProductRepository::create($data);
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
