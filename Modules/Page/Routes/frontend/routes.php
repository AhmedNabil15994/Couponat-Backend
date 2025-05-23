<?php


Route::get('/pages/{page}', function () {
    return view('page::frontend.show');
})->name('frontend.pages.show');
