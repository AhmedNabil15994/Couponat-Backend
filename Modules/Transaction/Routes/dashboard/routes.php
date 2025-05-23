<?php

Route::group(['prefix' => 'transactions'], function () {
    Route::get('/', 'TransactionController@index')
    ->name('dashboard.transactions.index')
    ->middleware(['permission:show_transactions']);

    Route::get('datatable', 'TransactionController@datatable')
    ->name('dashboard.transactions.datatable')
    ->middleware(['permission:show_transactions']);
});
