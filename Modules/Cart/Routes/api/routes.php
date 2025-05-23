<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'cart' ], function () {
    Route::get('/', 'CartController@index')->name('api.cart.index');
    Route::post('add/{id}', 'CartController@createOrUpdate')->name('api.cart.add');
    Route::delete('remove/{id}', 'CartController@remove')->name('api.cart.remove');
    Route::post('clear', 'CartController@clear')->name('api.cart.clear');
    Route::post('remove-condition/{condition_name}', 'CartController@removeCondition')->name('api.cart.removeCondition');
});
