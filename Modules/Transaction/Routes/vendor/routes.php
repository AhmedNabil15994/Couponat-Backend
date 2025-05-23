<?php

Route::group(['prefix' => 'transactions'], function () {
    Route::get('/', 'TransactionController@index')
    ->name('vendor.transactions.index')
    ->middleware(['permission:show_transactions']);

    Route::get('datatable', 'TransactionController@datatable')
    ->name('vendor.transactions.datatable')
    ->middleware(['permission:show_transactions']);
});
