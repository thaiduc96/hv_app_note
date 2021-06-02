<?php

use Illuminate\Support\Facades\Route;


Route::group(['prefix' => ''], function () {
    Route::resource('products', 'ProductController', ['as' => 'admin']);
    Route::patch('products/{id}/recovery', 'ProductController@recovery')->name('admin.products.recovery');

    Route::group(['prefix' => 'product-images'], function () {
        Route::get('', 'ProductImageController@index')->name('admin.productImages.index');
        Route::post('', 'ProductImageController@uploadImage')->name('admin.productImages.uploadImage');
        Route::delete('{id}', 'ProductImageController@destroy')->name('admin.productImages.destroy');
    });

});
