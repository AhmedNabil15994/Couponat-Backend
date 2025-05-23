<?php

use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'auth'], function () {
    Route::post( 'send-otp', 'LoginController@sendingOtp')->name('api.auth.send.otp');
    Route::post('login', 'LoginController@postLogin')->name('api.auth.login');
    Route::post('verified', 'RegisterController@verified')->name('api.auth.verified');
    Route::post('send-code', 'RegisterController@resendCode')->name('api.auth.resendCode');
    Route::post('register', 'RegisterController@register')->name('api.auth.register');
    Route::post('forget-password', 'ForgotPasswordController@forgetPassword')->name('api.auth.password.forget');
    Route::post('forget-password-email', 'ForgotPasswordController@forgetPasswordByEmail')->name('api.auth.password.forget.email');

    Route::group(['prefix' => '/', 'middleware' => 'auth:sanctum'], function () {

        Route::post('logout', 'LoginController@logout')->name('api.auth.logout');
    });
});
