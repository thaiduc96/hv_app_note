<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix' =>'api/v1','middleware' => 'api'], function () {
    include_once('items/auth.php');
    include_once('items/config.php');
    include_once('items/shop.php');
    include_once('items/product.php');
    include_once('items/order.php');
});
