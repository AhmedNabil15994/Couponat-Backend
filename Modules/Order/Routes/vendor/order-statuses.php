<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'order-statuses'], function () {
    Route::get('/', 'OrderStatusController@index')
    ->name('vendor.order-statuses.index')
    ->middleware(['permission:show_order_statuses']);

    Route::get('datatable', 'OrderStatusController@datatable')
    ->name('vendor.order-statuses.datatable')
    ->middleware(['permission:show_order_statuses']);

    Route::get('create', 'OrderStatusController@create')
    ->name('vendor.order-statuses.create')
    ->middleware(['permission:add_order_statuses']);

    Route::post('/', 'OrderStatusController@store')
    ->name('vendor.order-statuses.store')
    ->middleware(['permission:add_order_statuses']);

    Route::get('{id}/edit', 'OrderStatusController@edit')
    ->name('vendor.order-statuses.edit')
    ->middleware(['permission:edit_order_statuses']);

    Route::put('{id}', 'OrderStatusController@update')
    ->name('vendor.order-statuses.update')
    ->middleware(['permission:edit_order_statuses']);

    Route::delete('{id}', 'OrderStatusController@destroy')
    ->name('vendor.order-statuses.destroy')
    ->middleware(['permission:delete_order_statuses']);

    Route::get('deletes', 'OrderStatusController@deletes')
    ->name('vendor.order-statuses.deletes')
    ->middleware(['permission:delete_order_statuses']);

    Route::get('{id}', 'OrderStatusController@show')
    ->name('vendor.order-statuses.show')
    ->middleware(['permission:show_order_statuses']);
});
