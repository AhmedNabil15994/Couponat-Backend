<?php

use Illuminate\Support\Facades\Route;

Route::get('/checkout', 'OrderController@createView')->name('frontend.order.create.view');
Route::post('/checkout', 'OrderController@create')->name('frontend.order.create');
Route::group(['prefix' => 'checkout' , 'middleware' => [ 'auth' ]], function () {
    Route::post('event', 'OrderController@event')->name('frontend.order.event');
    Route::get('order-completed', 'OrderController@orderCompleted')->name('frontend.order.completed');
});

Route::get('success-upayment', 'OrderController@successUpayment')->name('frontend.orders.success.upayment');
Route::get('success-tap', 'OrderController@successTap')->name('frontend.orders.success.tap');
Route::get('myfatoorah-callback', 'OrderController@myFatoorahCallBack')->name('frontend.orders.myfatoorah.callback');

Route::get('success', 'OrderController@success')->name('frontend.orders.success');
Route::get('failed', 'OrderController@failed')->name('frontend.orders.failed');
