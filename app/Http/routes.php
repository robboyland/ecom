<?php

Route::get('cms', 'CmsController@index');

Route::get('checkout/customer', 'CheckoutController@details');
Route::post('checkout/register', 'CheckoutController@register');
Route::get('checkout/payment', 'CheckoutController@payment');
Route::post('checkout/charge', 'CheckoutController@charge');
Route::get('order/confirmation', 'CheckoutController@confirmation');

Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::get('dashboard', 'UsersController@dashboard');

Route::resource('cart', 'CartController',
                ['only' => ['index', 'store', 'destroy']]);

Route::resource('items', 'ItemsController');
Route::resource('categories', "CategoriesController");

Route::get('/{id}', 'StoreController@show');
Route::get('/', 'StoreController@index');

