<?php
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => ''], function () {

    Route::resource('products', 'ProductController', ['as' => 'admin']);
    Route::patch('products/{id}/recovery', 'ProductController@recovery')->name('admin.products.recovery');

});
