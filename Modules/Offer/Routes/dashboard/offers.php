<?php
use Illuminate\Support\Facades\Route;

Route::name('dashboard.')->group( function () {

    Route::get('offers/datatable'	,'OfferController@datatable')
        ->name('offers.datatable');

    Route::get('offers/{id}/copy'	,'OfferController@copy')
        ->name('offers.copy');

    Route::get('offers/deletes'	,'OfferController@deletes')
        ->name('offers.deletes');

    Route::get('offers/redeem/{code}','OfferController@redeem')->name('offers.redeem');
    Route::get('offers/searchAjax','OfferController@searchAjax')->name('offers.searchAjax');
    Route::post('offers/deleteMediaFiles','OfferController@deleteMediaFiles')->name('offers.deleteMediaFiles');


    Route::resource('offers','OfferController')->names('offers');
});
