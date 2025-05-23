<?php
use Illuminate\Support\Facades\Route;

Route::name('dashboard.')->group( function () {

    Route::get('logs-s/datatable'	,'LogController@datatable')
        ->name('logs-s.datatable');

    Route::get('logs-s/deletes'	,'LogController@deletes')
        ->name('logs-s.deletes');

    Route::resource('logs-s','LogController')->names('logs-s')->only('index','destroy');
});
