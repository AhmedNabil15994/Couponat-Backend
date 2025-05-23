<?php

//use Vsch\TranslationManager\Translator;


Route::group(['prefix' => '/' , 'middleware' => [ 'vendor.auth','check.permission']], function() {

  Route::get('/' , 'DashboardController@index')->name('vendor.home');
  Route::get('/statistics' , 'DashboardController@statistics')->name('vendor.statistics');

//  Route::group(['prefix' => 'translations'], function () {
//      Translator::routes();
//  });

  Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

});
