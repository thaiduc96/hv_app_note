<?php

namespace App\Modules\Api\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\Facades\ProductRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request){

        $key = ProductRepository::filter($request->all());
        return $this->successResponse($key);
    }
}
