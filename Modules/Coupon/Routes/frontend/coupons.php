<?php

Route::group(['prefix' => 'coupons'], function () {

    Route::post('/check_coupon', 'CouponController@checkCoupon')
        ->name('frontend.check_coupon');


});
