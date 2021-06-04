<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix' =>'auth', 'namespace' => 'Auth'], function () {
    Route::post('login', 'LoginController@login');

    Route::post('register', 'RegisterController@register');


    Route::post('login-device-token', 'DeviceTokenController@store');

//    Route::patch('register-verify', 'RegisterController@verifyCode');
//    Route::post('register-verify-resend', 'RegisterController@resendCode');
//
    Route::post('forgot-password', 'ForgotEmailPasswordController@sendCode');
    Route::post('verify-forgot-password', 'ForgotEmailPasswordController@verifyCode');

    Route::group([ 'middleware' => ['auth:'. GUARD_API ]], function () {
        Route::post('logout', 'LogoutController@logout');
        Route::patch('change-password', 'ChangePasswordController@changePassword');
//        Route::patch('password/reset', 'ForgotEmailPasswordController@changePassword');
//
    });
});



