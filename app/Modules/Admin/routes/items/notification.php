<?php

use Illuminate\Support\Facades\Route;


Route::group(['prefix' => ''], function () {
    Route::resource('notifications', 'NotificationController', ['as' => 'admin']);
    Route::patch('notifications/{id}/recovery', 'NotificationController@recovery')->name('admin.notifications.recovery');
});
