<?php

use Illuminate\Support\Facades\Route;

Route::name('dashboard.')->group(function () {

    Route::controller('AdminController')->group(function () {
        Route::get('admins/datatable', 'datatable')->name('admins.datatable');
        Route::get('admins/deletes', 'deletes')->name('admins.deletes');
    });

    Route::controller('SellerController')->group(function () {
        Route::get('sellers/datatable', 'datatable')->name('sellers.datatable');
        Route::get('sellers/deletes', 'deletes')->name('sellers.deletes');
    });

    Route::controller('EmployeeController')->group(function () {
        Route::get('employees/datatable', 'datatable')->name('employees.datatable');
        Route::get('employees/deletes', 'deletes')->name('employees.deletes');
    });

    Route::controller('UserController')->group(function () {
        Route::get('users/datatable', 'datatable')->name('users.datatable');
        Route::get('users/deletes', 'deletes')->name('users.deletes');
        Route::get('users/verify/{id}', 'verify')->name('users.verify');
    });


    Route::resources([
        'users'  => 'UserController',
        'admins' => 'AdminController',
        'sellers' => 'SellerController',
        'employees' => 'EmployeeController'
    ]);
});
