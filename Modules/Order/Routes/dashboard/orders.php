<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'orders'], function () {
    Route::get('/active_orders', 'OrderController@active_orders')
        ->name('dashboard.orders.active_orders')
        ->middleware(['permission:show_orders']);
    Route::get('/failed_orders', 'OrderController@failed_orders')
        ->name('dashboard.orders.failed_orders')
        ->middleware(['permission:show_orders']);

    Route::get('/pending_orders', 'OrderController@pending_orders')
        ->name('dashboard.orders.pending_orders')
        ->middleware(['permission:show_orders']);


    Route::get('logs', 'OrderController@logs')
    ->name('dashboard.orders.logs')
    ->middleware(['permission:show_orders']);

    Route::get('read/logs', 'OrderController@updateToReadOrders')
    ->name('dashboard.orders.update.logs')
    ->middleware(['permission:show_orders']);

    Route::get('/', 'OrderController@index')
    ->name('dashboard.orders.index')
    ->middleware(['permission:show_orders']);

    Route::get('datatable', 'OrderController@datatable')
    ->name('dashboard.orders.datatable')
    ->middleware(['permission:show_orders']);

    Route::get('create', 'OrderController@create')
    ->name('dashboard.orders.create')
    ->middleware(['permission:add_orders']);

    Route::post('/', 'OrderController@store')
    ->name('dashboard.orders.store')
    ->middleware(['permission:add_orders']);

    Route::get('{id}/edit', 'OrderController@edit')
    ->name('dashboard.orders.edit')
    ->middleware(['permission:edit_orders']);

    Route::put('{id}', 'OrderController@update')
    ->name('dashboard.orders.update')
    ->middleware(['permission:edit_orders']);

    Route::delete('{id}', 'OrderController@destroy')
    ->name('dashboard.orders.destroy')
    ->middleware(['permission:delete_orders']);

    Route::get('deletes', 'OrderController@deletes')
    ->name('dashboard.orders.deletes')
    ->middleware(['permission:delete_bulk_orders']);

    Route::get('{id}', 'OrderController@show')
    ->name('dashboard.orders.show')
    ->middleware(['permission:show_orders']);

    Route::get('/invoice/{id}', 'OrderController@invoice')
        ->name('dashboard.orders.invoice')
        ->middleware(['permission:show_orders']);

});
