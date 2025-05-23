<?php

Route::group(['prefix' => 'roles'], function () {

  	Route::get('/' ,'RoleController@index')
  	->name('trainer.roles.index');

  	Route::get('datatable'	,'RoleController@datatable')
  	->name('trainer.roles.datatable');

  	Route::get('create'		,'RoleController@create')
  	->name('trainer.roles.create');

  	Route::post('/'			,'RoleController@store')
  	->name('trainer.roles.store');

  	Route::get('{id}/edit'	,'RoleController@edit')
  	->name('trainer.roles.edit');

  	Route::put('{id}'		,'RoleController@update')
  	->name('trainer.roles.update');

  	Route::delete('{id}'	,'RoleController@destroy')
  	->name('trainer.roles.destroy');

  	Route::get('deletes'	,'RoleController@deletes')
  	->name('trainer.roles.deletes');

  	Route::get('{id}','RoleController@show')
  	->name('trainer.roles.show');

});
