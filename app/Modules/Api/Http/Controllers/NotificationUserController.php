<?php

namespace App\Modules\Api\Http\Controllers;

use App\Helpers\AuthHelper;
use App\Http\Controllers\Controller;
use App\Repositories\Facades\NotificationUserRepository;
use Illuminate\Http\Request;

class NotificationUserController extends Controller
{
    public function index(Request $request){

        if(AuthHelper::getGuardApi()->check()){
            $request->merge([
                'user_id' => AuthHelper::getUserApiId()
            ]);
        }
        $key = NotificationUserRepository::filter($request->all());
        return $this->successResponse($key);
    }

    public function show($id){

        $key = NotificationUserRepository::findOrFail($id);
        return $this->successResponse($key);
    }
}
