<?php

Route::group(['prefix' => 'faqs'], function () {
    Route::get('/', 'FaqController@index')
    ->name('dashboard.faqs.index');

    Route::get('datatable', 'FaqController@datatable')
    ->name('dashboard.faqs.datatable');

    Route::get('create', 'FaqController@create')
    ->name('dashboard.faqs.create');

    Route::post('/', 'FaqController@store')
    ->name('dashboard.faqs.store');

    Route::get('{id}/edit', 'FaqController@edit')
    ->name('dashboard.faqs.edit');

    Route::put('{id}', 'FaqController@update')
    ->name('dashboard.faqs.update');

    Route::delete('{id}', 'FaqController@destroy')
    ->name('dashboard.faqs.destroy');

    Route::get('deletes', 'FaqController@deletes')
    ->name('dashboard.faqs.deletes');

    Route::get('{id}', 'FaqController@show')
    ->name('dashboard.faqs.show');
});
