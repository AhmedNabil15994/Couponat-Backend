<?php

 Route::group(['prefix' => 'register'], function () {

     // Show Register Form
     Route::get('/', 'RegisterController@show')
     ->name('frontend.auth.register')
     ->middleware('guest');

     // Submit Register
     Route::post('/', 'RegisterController@register')
     ->name('frontend.auth.register.post');
 });

Route::group(['prefix' => 'login'], function () {

    // Show Login Form
    Route::get('/', 'LoginController@showLogin')
    ->name('frontend.auth.login')
    ->middleware('guest');

    // Submit Login
    Route::post('/', 'LoginController@postLogin')
    ->name('frontend.auth.login.post');
});

Route::post('/verifyCode', 'RegisterController@verifyCode')
    ->name('frontend.auth.verify')
    ->middleware('guest');

Route::group(['prefix' => 'logout','middleware' => 'auth'], function () {
    Route::any('/', 'LoginController@logout')
    ->name('frontend.auth.logout');
});

 Route::group(['prefix' => 'reset'], function () {

     // Show Forget Password Form
     Route::get('{token}', 'ResetPasswordController@resetPassword')
     ->name('frontend.password.reset')
     ->middleware('guest');

     // Send Forget Password Via Mail
     Route::post('/', 'ResetPasswordController@updatePassword')
     ->name('frontend.password.update');
 });


 Route::group(['prefix' => 'password'], function () {

     // Show Forget Password Form
     Route::get('forget', 'ForgotPasswordController@forgetPassword')
     ->name('frontend.auth.password.request')
     ->middleware('guest');

     // Send Forget Password Via Mail
     Route::post('forget', 'ForgotPasswordController@sendForgetPassword')
     ->name('frontend.auth.password.email');
 });
