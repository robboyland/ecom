<?php

Route::resource('items', 'ItemsController');
Route::resource('categories', "CategoriesController");

Route::get('/{id}', 'StoreController@show');
Route::get('/', 'StoreController@index');

