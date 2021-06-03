<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::group(['prefix' => 'admin', 'middleware' => ['web']], function () {

    include_once('items/auth.php');

    Route::group(['middleware' => ['auth']], function () {
        Route::get('/', 'AdminController@welcome')->name('admin.dashboard');

        include_once('items/notification.php');
        include_once('items/product.php');
        include_once('items/shop.php');
        include_once('items/order.php');
    });

});

