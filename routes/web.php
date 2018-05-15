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

Route::get('/', function () {
    return view('welcome');
});

Route::get('hello', function () {
    return 'Welcome to Xiao hu!';
});

Route::get('user_index', 'UsersController@index')->name('user.index');

Route::get('user_create', 'UsersController@create')->name('user.add');
Route::post('user_store', 'UsersController@store')->name('user.store');

Route::post('user_delete', 'UsersController@delete')->name('user.delete');
