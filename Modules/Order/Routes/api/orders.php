<?php

use Illuminate\Support\Facades\Route;
//
Route::group(['middleware' => [ 'auth:sanctum' ]], function () {
    Route::post('/checkout', 'OrderController@create')->name('api.order.create');
    Route::get('/orders', 'OrderController@index')->name('api.orders.index');
    Route::get('/orders/{id}', 'OrderController@show')->name('api.orders.show');
    Route::post('/orders/{id}/cancel', 'OrderController@cancel')->name('api.orders.cancel');
});

Route::get('success-upayment', 'OrderController@successUpayment')->name('api.orders.success.upayment');
Route::get('failed-upayment', 'OrderController@failedUpayment')->name('api.orders.failed.upayment');

Route::get('success-tap', 'OrderController@successTap')->name('api.orders.success.tap');
Route::get('failed-tap', 'OrderController@failedUpayment')->name('api.orders.failed.tap');
