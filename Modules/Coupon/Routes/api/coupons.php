<?php

Route::group(['prefix' => 'coupons'], function () {

  	Route::post('/check_coupon' ,'CouponController@check_coupon')
  	->name('api.check_coupon');


});
