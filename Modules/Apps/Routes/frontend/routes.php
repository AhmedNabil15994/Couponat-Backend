<?php

Route::get('/', 'AppsController@index')->name('frontend.home');
Route::get('/about-us', 'AppsController@about_us')->name('frontend.about_us');
Route::get('/terms', 'AppsController@terms')->name('frontend.terms');
Route::get('/faq', 'AppsController@faq')->name('frontend.faq');
Route::get('/contact-us', 'AppsController@contact_us')->name('frontend.contact_us');
Route::post('/contact-us', 'AppsController@post_contact_us')->name('frontend.post_contact_us');
Route::get('/coming-soon', 'AppsController@coming_soon')->name('frontend.coming_soon');
