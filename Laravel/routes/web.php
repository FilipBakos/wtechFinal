<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Item;

Route::get('/', 'ItemController@showAll');
Route::get('/cd', 'ItemController@showCD');
Route::get('/lp', 'ItemController@showLP');
Route::get('/dvd', 'ItemController@showDVD');


Auth::routes();

Route::get('/user', [
    'middleware' => 'auth',
    'as' => 'user',
    'uses' => 'UserController@getUser'
]);

Route::get('/user-logout', [
    'as' => 'userLogout',
    'uses' => 'Auth\LoginController@logout'
]);
Route::get('/filter/{type}', 'ItemController@filter');
Route::post('/filter/{type}', 'ItemController@filter');

Route::resource('/item','ItemController');

Route::get('/basket',[
    'middleware' => 'auth',
    'as' => 'basket',
    'uses' => 'OrderController@showBasket'
]);

Route::post('/basket/{id}',[
    'middleware' => 'auth',
    'as' => 'basket-add',
    'uses' => 'OrderController@addToBasket'
]);
Route::get('/basket/{id}',[
    'middleware' => 'auth',
    'as' => 'basket-add',
    'uses' => 'OrderController@addToBasket'
]);
Route::get('/basket/remove/{id}',[
    'middleware' => 'auth',
    'as' => 'basket-remove',
    'uses' => 'OrderController@removeFromBasket'
]);

Route::get('/order-form',[
    'middleware' => 'auth',
    'as' => 'order-form',
    'uses' => 'OrderController@showOrderForm'
]);

Route::post('/order-methods',[
    'middleware' => 'auth',
    'as' => 'order-methods',
    'uses' => 'OrderController@showMethods'
]);

Route::post('/order-sum/{id}',[
    'middleware' => 'auth',
    'as' => 'order-sum',
    'uses' => 'OrderController@showSum'
]);

Route::get('/confirm/{id}',[
    'middleware' => 'auth',
    'as' => 'confirm',
    'uses' => 'OrderController@confirmOrder'
]);

Route::get('/genres', 'ItemController@getArtists');

Route::get('/users/list', 'UserController@list'); //pre quasar
Route::get('/products/list', 'ItemController@list'); //pre quasar
Route::get('products/list/{page}', 'ItemController@list');
Route::delete('products/{id}', 'ItemController@destroy');
Route::get('products/{product}/edit', 'ItemController@edit');
Route::put('products/{product}', 'ItemController@update');

Route::put('products/{product}', 'ItemController@update');

Route::post('/image/store', 'ItemController@storeImage');
Route::post('/products/', 'ItemController@store');
