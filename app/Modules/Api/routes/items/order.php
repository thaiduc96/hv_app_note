<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'orders'], function () {
    Route::get('', 'OrderController@index');
    Route::post('', 'OrderController@create');
});
