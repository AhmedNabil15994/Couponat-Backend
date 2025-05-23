<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/offers' ], function () {
    Route::get('/', 'OfferController@index')->name('api.offers.index');
    Route::get('/{id}', 'OfferController@show')->name('api.offers.show');

});
