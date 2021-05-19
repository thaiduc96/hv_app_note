<?php

namespace App\Modules\Api\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\Facades\ShopRepository;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request){
        $key = ShopRepository::filter($request->all());
        return $this->successResponse($key);
    }
}
