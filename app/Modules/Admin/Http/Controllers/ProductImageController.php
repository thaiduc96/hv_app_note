<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Helpers\ImageHelper;
use App\Helpers\UploadHelper;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Modules\Admin\Http\Requests\Product\CreateProductRequest;
use App\Modules\Admin\Http\Requests\Product\UpdateProductRequest;
use App\Repositories\Facades\ProductImageRepository;
use App\Repositories\Facades\ProductRepository;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ProductImageController extends Controller
{

    public function index(Request $request){
        $list = ProductImageRepository::filter($request->all());
        return $this->successResponse($list);
    }

    public function uploadImage(Request $request)
    {
        $path = UploadHelper::uploadFromRequest('file', config('uploadpath.product'));
        if (is_array($path)) {
            $image = [];
            foreach ($path as $p) {
                $thumbnail = ImageHelper::createImageThumbnail($p, config('uploadpath.product'));
                $i = ProductImageRepository::create([
                    'image' => $p,
                    'image_thumbnail' => $thumbnail
                ]);
                $image[] = $i;
            }
        } else {
            $thumbnail = ImageHelper::createImageThumbnail($path, config('uploadpath.product'));
            $image = ProductImageRepository::create([
                'image' => $path,
                'image_thumbnail' => $thumbnail
            ]);
        }

        return $this->successResponse($image);
    }

    public function destroy($id)
    {
        $model = ProductImageRepository::findOrFail($id);
        DB::beginTransaction();
        try {
            UploadHelper::delete($model->image);
            ProductImageRepository::delete($model);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        return $this->successResponse(true);
    }

}
