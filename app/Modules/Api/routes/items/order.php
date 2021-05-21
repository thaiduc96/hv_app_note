<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'orders'], function () {
    Route::get('', 'OrderController@index');
    Route::get('{id}', 'OrderController@show');
    Route::post('', 'OrderController@create');
    Route::put('{id}', 'OrderController@update');
});
