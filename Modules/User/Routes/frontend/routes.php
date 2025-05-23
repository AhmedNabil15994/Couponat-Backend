<?php

Route::name('frontend.profile.')->prefix('profile')->group(function () {

    Route::get('/', 'ProfileController@index')->name('index');
    Route::get('/change-password', 'ProfileController@change_pass')->name('change_pass');
    Route::post('/change-password', 'ProfileController@post_change_pass')->name('post_change_pass');

    Route::get('/favourites', 'ProfileController@favourites')->name('favourites.index');


    Route::get('/my-orders', 'ProfileController@myOrders')->name('my-orders');
    Route::get('/my-orders/{id}/show', 'ProfileController@showOrder')->name('my-orders.show');


    Route::get('/edit', 'ProfileController@edit')->name('edit');
    Route::post('/update', 'ProfileController@update')->name('update');
});
