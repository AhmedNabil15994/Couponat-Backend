<?php
use Illuminate\Support\Facades\Route;

Route::name('vendor.')->group( function () {

    Route::get('areas/datatable'	,'AreaController@datatable')
        ->name('areas.datatable');

    Route::get('countries/deletes'	,'AreaController@deletes')
        ->name('areas.deletes');

    Route::resource('areas','AreaController')->names('areas');

});
