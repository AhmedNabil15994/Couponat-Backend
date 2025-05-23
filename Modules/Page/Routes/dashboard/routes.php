<?php

use Illuminate\Support\Facades\Route;

Route::name('dashboard.')->group( function () {

    Route::get('pages/datatable'	,'PageController@datatable')
        ->name('pages.datatable');

    Route::get('pages/deletes'	,'PageController@deletes')
        ->name('pages.deletes');

    Route::resource('pages','PageController')->names('pages');
});
