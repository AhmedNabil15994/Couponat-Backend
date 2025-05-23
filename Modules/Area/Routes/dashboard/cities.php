<?php
use Illuminate\Support\Facades\Route;

Route::name('dashboard.')->group( function () {

    Route::get('cities/datatable'	,'CityController@datatable')
        ->name('cities.datatable');

    Route::get('cities/deletes','CityController@deletes')
        ->name('cities.deletes');

    Route::resource('cities','CityController')->names('cities');

});