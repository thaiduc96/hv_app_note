<?php
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => ''], function () {
    Route::resource('shops', 'ShopController', ['as' => 'admin']);
    Route::patch('shops/{id}/recovery', 'ShopController@recovery')->name('admin.shops.recovery');
});
