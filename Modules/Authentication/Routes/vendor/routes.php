<?php

Route::group(['prefix' => 'login'], function () {
    // if (env('LOGIN')):

    // Show Login Form
    Route::get('/', 'LoginController@showLogin')
        ->name('vendor.login')
        ->middleware('guest');

    // Submit Login
    Route::post('/', 'LoginController@postLogin')->name('vendor.login.post');

    // endif;
});


Route::group(['prefix' => 'logout','middleware' => 'vendor.auth'], function () {

    // Logout
    Route::any('/', 'LoginController@logout')
    ->name('vendor.logout');
});
