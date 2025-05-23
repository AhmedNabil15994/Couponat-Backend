<?php

//use Vsch\TranslationManager\Translator;


Route::group(['prefix' => '/' , 'middleware' => [ 'dashboard.auth','check.permission']], function() {

    Route::get('/' , 'DashboardController@index')->name('dashboard.home');
    Route::get('/statistics' , 'DashboardController@statistics')->name('dashboard.statistics');

//  Route::group(['prefix' => 'translations'], function () {
//      Translator::routes();
//  });

  Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

});
