<?php
use Illuminate\Support\Facades\Route;

Route::name('dashboard.')->group( function () {

    Route::get('categories/datatable'	,'CategoryController@datatable')
        ->name('categories.datatable');

    Route::get('categories/deletes'	,'CategoryController@deletes')
        ->name('categories.deletes');

    Route::resource('categories','CategoryController')->names('categories');
});
