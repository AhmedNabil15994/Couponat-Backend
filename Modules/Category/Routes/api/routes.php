<?php

Route::group(['prefix' => 'categories'], function () {

    Route::get('/'  , 'CategoryController@categories');
    Route::get('/{id}'  , 'CategoryController@show');

});
