<?php
use Illuminate\Support\Facades\Route;

Route::name('dashboard.')->group( function () {

    Route::get('states/datatable'	,'StateController@datatable')
        ->name('states.datatable');

    Route::get('states/deletes'	,'StateController@deletes')
        ->name('states.deletes');

    Route::get('states/getByCityId/{city_id}'	,'StateController@getByCityId')
        ->name('states.getByCityId');

    Route::resource('states','StateController')->names('states');
});
