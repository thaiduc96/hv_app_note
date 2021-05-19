<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix' =>'shops'], function () {
    Route::get('', 'ShopController@index');
});
