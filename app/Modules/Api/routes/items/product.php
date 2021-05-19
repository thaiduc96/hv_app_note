<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix' =>'products'], function () {
    Route::get('', 'ProductController@index');
});
