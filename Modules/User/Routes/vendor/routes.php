<?php

use Illuminate\Support\Facades\Route;

Route::name('vendor.')->group(function () {


    Route::controller('UserController')->group(function () {
        Route::get('users/datatable', 'datatable')->name('users.datatable');
        Route::get('users/deletes', 'deletes')->name('users.deletes');
    });


    Route::controller('EmployeeController')->group(function () {
        Route::get('employees/datatable', 'datatable')->name('employees.datatable');
        Route::get('employees/deletes', 'deletes')->name('employees.deletes');
    });



    Route::resources([
        'users'  => 'UserController',
        'employees' => 'EmployeeController'
    ]);
});
