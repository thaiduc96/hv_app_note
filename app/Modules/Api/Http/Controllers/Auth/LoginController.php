<?php

namespace App\Modules\Api\Http\Controllers\Auth;

use App\Facades\DeviceTokenFacade;
use App\Facades\UserFacade;
use App\Helpers\AuthHelper;
use App\Http\Controllers\Controller;
use App\Modules\Api\Http\Requests\Auth\LoginRequest;


class LoginController extends Controller
{

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if ($token = AuthHelper::getGuardApi()->attempt($credentials)) {
            $user = AuthHelper::getUserApi();

            DeviceTokenFacade::create($request->only('device_token','device_type'), $user);
            return $this->successResponse(UserFacade::getUserLogin(GUARD_API,$token));
        }
        return $this->failedResponse(trans('message.wrong_username_or_password'));
    }
}
