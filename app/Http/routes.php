<?php

Route::resource('items', 'ItemsController');

Route::get('/', function () {
    return view('welcome');
});
