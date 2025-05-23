<?php
use Illuminate\Support\Facades\Route;

Route::name('dashboard.')->group( function () {



    Route::get('reports/vendors-sales'	,'ReportController@vendors')
        ->name('reports.vendors');

    Route::get('reports/vendors-datatable'	,'ReportController@vendors_datatable')
        ->name('reports.vendors_datatable');

    Route::get('reports/customers-sales'	,'ReportController@customers')
        ->name('reports.customers');

    Route::get('reports/customers-datatable'	,'ReportController@customers_datatable')
        ->name('reports.customers_datatable');

    Route::get('reports/offers-sales'	,'ReportController@offers')
        ->name('reports.offers');

    Route::get('reports/offers-datatable'	,'ReportController@offers_datatable')
        ->name('reports.offers_datatable');

});
