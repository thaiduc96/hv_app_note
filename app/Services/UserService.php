<?php

namespace App\Services;

use App\Helpers\AuthHelper;
use Illuminate\Support\Facades\Auth;

class UserService
{
    public function getUserLogin($guard, $token)
    {
        return [
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::guard($guard)->factory()->getTTL() * 60,
            'user' => Auth::guard($guard)->user()
        ];
    }

    public function loginByUser($user){
        return AuthHelper::getGuardApi()->login($user);
    }
}
