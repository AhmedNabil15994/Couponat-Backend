<?php

Route::group(['prefix' => 'permissions' , 'middleware' => [ 'trainer.auth','permission:trainer_access' ]], function () {

  	Route::get('/' ,'PermissionController@index')
  	->name('trainer.permissions.index');

  	Route::get('datatable'	,'PermissionController@datatable')
  	->name('trainer.permissions.datatable');

  	Route::get('create'		,'PermissionController@create')
  	->name('trainer.permissions.create');

  	Route::post('/'			,'PermissionController@store')
  	->name('trainer.permissions.store');

  	Route::get('{id}/edit'	,'PermissionController@edit')
  	->name('trainer.permissions.edit');

  	Route::put('{id}'		,'PermissionController@update')
  	->name('trainer.permissions.update');

  	Route::delete('{id}'	,'PermissionController@destroy')
  	->name('trainer.permissions.destroy');

  	Route::get('deletes'	,'PermissionController@deletes')
  	->name('trainer.permissions.deletes');

  	Route::get('{id}','PermissionController@show')
  	->name('trainer.permissions.show');

});
