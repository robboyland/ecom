<?php

Route::resource('items', 'ItemsController');

Route::get('/{id}', 'StoreController@show');
Route::get('/', 'StoreController@index');

