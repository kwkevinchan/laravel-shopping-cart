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

Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('login', 'Auth\LoginController@index')->name('login');
Route::post('login', 'Auth\LoginController@login');

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', function () {
        return view('index');
    });

    Route::resource('productClass', 'ProductClassController', ['only' => ['index', 'create', 'store', 'edit', 'update', 'destroy']]);
    Route::resource('product', 'ProductController');
    Route::resource('user', 'UserController');
    Route::resource('product', 'ProductController');
    Route::get('consumer/cart', 'ConsumerController@cart')->name('consumer.cart');
    Route::post('consumer/create', 'ConsumerController@create')->name('consumer.create');
    Route::get('consumer/remove/{id}', 'ConsumerController@remove')->name('consumer.remove');
    Route::resource('consumer', 'ConsumerController', ['only' => ['index', 'show']]);
});