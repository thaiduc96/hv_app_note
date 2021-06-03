<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix' =>'notifications'], function () {
    Route::get('', 'NotificationUserController@index');
    Route::get('{id}', 'NotificationUserController@show');
});
