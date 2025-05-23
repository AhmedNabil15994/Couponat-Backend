<?php
use Illuminate\Support\Facades\Route;

Route::name('vendor.')->group( function () {

    Route::get('offers/datatable'	,'OfferController@datatable')
        ->name('offers.datatable');

    Route::get('offers/deletes'	,'OfferController@deletes')
        ->name('offers.deletes');

    Route::get('offers/{id}/copy'	,'OfferController@copy')
        ->name('offers.copy');

    Route::get('offers/searchAjax','OfferController@searchAjax')->name('offers.searchAjax');
    Route::get('offers/redeem/{code}','OfferController@redeem')->name('offers.redeem');
    Route::get('offers/successRedeem/{code}','OfferController@successRedeem')->name('offers.successRedeem');
    Route::post('offers/deleteMediaFiles','OfferController@deleteMediaFiles')->name('offers.deleteMediaFiles');
    Route::resource('offers','OfferController')->names('offers');
});
