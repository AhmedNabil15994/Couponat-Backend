<?php

Route::group(['prefix' => 'settings'], function () {
    Route::get('/', 'SettingController@settings')->name('api.settings.index');
});
