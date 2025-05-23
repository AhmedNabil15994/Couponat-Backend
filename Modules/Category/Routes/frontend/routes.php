<?php

use Modules\Category\Entities\Category;

Route::get('categories', 'ShowCategoryController@index')->name('frontend.categories.index');
Route::get('categories/{category}', 'ShowCategoryController@show')->name('frontend.categories.show');
