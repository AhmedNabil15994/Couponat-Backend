<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'orders'], function () {
    Route::get('/active_orders', 'OrderController@active_orders')
        ->name('vendor.orders.active_orders')
        ->middleware(['permission:show_orders']);
    Route::get('/failed_orders', 'OrderController@failed_orders')
        ->name('vendor.orders.failed_orders')
        ->middleware(['permission:show_orders']);

    Route::get('/pending_orders', 'OrderController@pending_orders')
        ->name('vendor.orders.pending_orders')
        ->middleware(['permission:show_orders']);


    Route::get('logs', 'OrderController@logs')
    ->name('vendor.orders.logs')
    ->middleware(['permission:show_orders']);

    Route::get('read/logs', 'OrderController@updateToReadOrders')
    ->name('vendor.orders.update.logs')
    ->middleware(['permission:show_orders']);

    Route::get('/', 'OrderController@index')
    ->name('vendor.orders.index')
    ->middleware(['permission:show_orders']);

    Route::get('datatable', 'OrderController@datatable')
    ->name('vendor.orders.datatable')
    ->middleware(['permission:show_orders']);

    Route::get('create', 'OrderController@create')
    ->name('vendor.orders.create')
    ->middleware(['permission:add_orders']);

    Route::post('/', 'OrderController@store')
    ->name('vendor.orders.store')
    ->middleware(['permission:add_orders']);

    Route::get('{id}/edit', 'OrderController@edit')
    ->name('vendor.orders.edit')
    ->middleware(['permission:edit_orders']);

    Route::put('{id}', 'OrderController@update')
    ->name('vendor.orders.update')
    ->middleware(['permission:edit_orders']);

    Route::delete('{id}', 'OrderController@destroy')
    ->name('vendor.orders.destroy')
    ->middleware(['permission:delete_orders']);

    Route::get('deletes', 'OrderController@deletes')
    ->name('vendor.orders.deletes')
    ->middleware(['permission:delete_orders']);

    Route::get('{id}', 'OrderController@show')
    ->name('vendor.orders.show')
    ->middleware(['permission:show_orders']);

});
