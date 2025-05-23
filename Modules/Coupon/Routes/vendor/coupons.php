<?php

Route::group(['prefix' => 'coupons'], function () {

    Route::get('/', 'CouponController@index')
        ->name('vendor.coupons.index')
        ;   // ->middleware(['permission:show_coupon']);

    Route::get('datatable', 'CouponController@datatable')
        ->name('vendor.coupons.datatable')
        ;   // ->middleware(['permission:show_coupon']);

    Route::get('create', 'CouponController@create')
        ->name('vendor.coupons.create')
        ;   // ->middleware(['permission:add_coupon']);

    Route::post('store', 'CouponController@store')
        ->name('vendor.coupons.store')
        ;   // ->middleware(['permission:add_coupon']);

    Route::get('{id}/edit', 'CouponController@edit')
        ->name('vendor.coupons.edit')
        ;   // ->middleware(['permission:edit_coupon']);

    Route::put('{id}', 'CouponController@update')
        ->name('vendor.coupons.update')
        ;   // ->middleware(['permission:edit_coupon']);

    Route::get('{id}/clone', 'CouponController@clone')
        ->name('vendor.coupons.clone')
        ;   // ->middleware(['permission:add_coupon']);

    Route::delete('{id}', 'CouponController@destroy')
        ->name('vendor.coupons.destroy')
        ;   // ->middleware(['permission:delete_coupon']);

    Route::get('deletes', 'CouponController@deletes')
        ->name('vendor.coupons.deletes')
        ;   // ->middleware(['permission:delete_coupon']);

    Route::get('{id}', 'CouponController@show')
        ->name('vendor.coupons.show')
        ;   // ->middleware(['permission:show_coupon']);

});
