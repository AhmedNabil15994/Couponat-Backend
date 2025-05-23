<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'shopping-cart' ], function () {
    Route::get('/', 'CartController@index')->name('frontend.cart.index');
    Route::get('add/{type}/{id}', 'CartController@add')->name('frontend.cart.add');
    Route::get('remove/{type}/{id}', 'CartController@remove')->name('frontend.cart.remove');
    Route::get('clear', 'CartController@clear')->name('frontend.cart.clear');
    Route::get('checkout', 'CartController@checkout')->name('frontend.cart.checkout');

});
