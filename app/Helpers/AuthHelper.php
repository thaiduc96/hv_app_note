<?php


namespace App\Helpers;


use Illuminate\Support\Facades\Auth;

class AuthHelper
{
    public static function getUserApi(){
        return self::getGuardApi()->user();
    }

    public static function getUserApiId(){
        return self::getGuardApi()->id();
    }

    public static function getGuardApi(){
        return Auth::guard(GUARD_API);
    }
}
