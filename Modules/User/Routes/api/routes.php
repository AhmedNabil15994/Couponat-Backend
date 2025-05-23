<?php

Route::group(['prefix' => '/auth', 'middleware' => 'auth:sanctum'], function () {

    Route::get('profile', 'UserController@profile')->name('api.auth.profile');
    Route::post('profile', 'UserController@updateProfile')->name('api.auth.update.profile');
    Route::post('change-password', 'UserController@changePassword')->name('api.auth.change.password');
    Route::post('delete-account', 'UserController@deleteAccount')->name('api.auth.delete.account');
});

Route::group(['prefix' => '/auth/favourites', 'middleware' => 'auth:sanctum'], function () {

    Route::get('/', 'UserFavouritesController@list')->name('api.favourites.list');
    Route::post('toggleFavorite', 'UserFavouritesController@toggleFav')->name('api.favourites.toggleFav');
});
