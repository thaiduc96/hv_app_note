<?php

namespace App\Modules\Api\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Modules\Api\Http\Requests\LoginDeviceTokenRequest;
use App\Repositories\Facades\DeviceTokenRepository;
use App\Repositories\Facades\ProductRepository;

class DeviceTokenController extends Controller
{
    public function store(LoginDeviceTokenRequest $request){

        $a =DeviceTokenRepository::firstOrCreate($request->only('device_token','device_type'));
        dd($a);
        return $this->successResponse(true);
    }
}
