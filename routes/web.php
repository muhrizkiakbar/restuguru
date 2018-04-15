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
    return view('login');
});

// User Route
Route::get('/users','UserController@index');
Route::get('/users/dataalluser','UserController@dataalluser')->name('dataalluser');
Route::post('/users/postuser','UserController@store')->name('storeuser');

// Cabang Route
Route::get('/cabang','CabangController@index');
Route::get('/cabang/loaddatacabang','CabangController@loaddatacabang')->name('loaddatacabang');
Route::post('/cabang/postcabang','CabangController@store')->name('storecabang');
