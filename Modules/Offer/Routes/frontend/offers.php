<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'offers'], function () {
    Route::get('/toggleFavorite/{id}', 'OfferController@toggleFavorite')->name('frontend.offers.toggleFavorite');
    Route::get('/show/{id}', 'OfferController@show')->name('frontend.offers.show');

});
