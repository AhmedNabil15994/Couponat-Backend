<?php

Route::group(['prefix' => 'pages'], function () {

    Route::get('/'      , 'PageController@pages')->name('api.pages.index');
    Route::get('{id}'   , 'PageController@page')->name('api.pages.show');

});
