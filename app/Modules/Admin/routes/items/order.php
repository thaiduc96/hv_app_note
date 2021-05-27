<?php
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => ''], function () {
    Route::resource('orders', 'OrderController', ['as' => 'admin']);
    Route::patch('orders/{id}/recovery', 'OrderController@recovery')->name('admin.orders.recovery');
});
