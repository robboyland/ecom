<?php

use Illuminate\Support\Facades\Session;

Route::resource('cart', 'CartController',
                ['only' => ['index', 'store', 'destroy']]);

Route::resource('items', 'ItemsController');
Route::resource('categories', "CategoriesController");

Route::get('/{id}', 'StoreController@show');
Route::get('/', 'StoreController@index');

