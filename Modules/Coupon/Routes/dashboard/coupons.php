<?php

Route::group(['prefix' => 'coupons'], function () {

    Route::get('/', 'CouponController@index')
        ->name('dashboard.coupons.index')
        ;   // ->middleware(['permission:show_coupon']);

    Route::get('datatable', 'CouponController@datatable')
        ->name('dashboard.coupons.datatable')
        ;   // ->middleware(['permission:show_coupon']);

    Route::get('create', 'CouponController@create')
        ->name('dashboard.coupons.create')
        ;   // ->middleware(['permission:add_coupon']);

    Route::post('store', 'CouponController@store')
        ->name('dashboard.coupons.store')
        ;   // ->middleware(['permission:add_coupon']);

    Route::get('{id}/edit', 'CouponController@edit')
        ->name('dashboard.coupons.edit')
        ;   // ->middleware(['permission:edit_coupon']);

    Route::put('{id}', 'CouponController@update')
        ->name('dashboard.coupons.update')
        ;   // ->middleware(['permission:edit_coupon']);

    Route::get('{id}/clone', 'CouponController@clone')
        ->name('dashboard.coupons.clone')
        ;   // ->middleware(['permission:add_coupon']);

    Route::delete('{id}', 'CouponController@destroy')
        ->name('dashboard.coupons.destroy')
        ;   // ->middleware(['permission:delete_coupon']);

    Route::get('deletes', 'CouponController@deletes')
        ->name('dashboard.coupons.deletes')
        ;   // ->middleware(['permission:delete_coupon']);

    Route::get('{id}', 'CouponController@show')
        ->name('dashboard.coupons.show')
        ;   // ->middleware(['permission:show_coupon']);

});
