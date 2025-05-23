<?php

Route::group(['prefix' => 'notifications'], function () {

    Route::get('/', 'NotificationController@index')
        ->name('dashboard.notifications.index');

    Route::get('datatable', 'NotificationController@datatable')
        ->name('dashboard.notifications.datatable');

    Route::get('create', 'NotificationController@notifyForm')
        ->name('dashboard.notifications.create');

    Route::post('send', 'NotificationController@push_notification')
        ->name('dashboard.notifications.store');

    Route::delete('{id}', 'NotificationController@destroy')
        ->name('dashboard.notifications.destroy');

    Route::get('deletes', 'NotificationController@deletes')
        ->name('dashboard.notifications.deletes');

});
