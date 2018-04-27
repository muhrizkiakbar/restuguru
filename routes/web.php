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
Route::post('/users/updateuser','UserController@update')->name('updateuser');
Route::post('/users/deleteuser','UserController@destroy')->name('deleteuser');

// Cabang Route
Route::get('/cabang','CabangController@index');
Route::get('/cabang/loaddatacabang','CabangController@loaddatacabang')->name('loaddatacabang');
Route::post('/cabang/postcabang','CabangController@store')->name('storecabang');
Route::post('/cabang/updatecabang','CabangController@update')->name('updatecabang');
Route::post('/cabang/deletecabang','CabangController@destroy')->name('deletecabang');

// Jenis Pelanggan Route
Route::get('/jenispelanggan','JenispelangganController@index');
Route::get('/jenispelanggan/loadjenispelanggan','JenispelangganController@loadjenispelanggan')->name('loadjenispelanggan');
Route::post('/jenispelanggan/postjenispelanggan','JenispelangganController@store')->name('storejenispelanggan');
Route::post('/jenispelanggan/updatejenispelanggan','JenispelangganController@update')->name('updatejenispelanggan');
Route::post('/jenispelanggan/deletejenispelanggan','JenispelangganController@destroy')->name('deletejenispelanggan');

// Kategori Route
Route::get('/kategori','KategoriController@index');
Route::get('/kategori/loadkategori','KategoriController@loadkategori')->name('loadkategori');
Route::post('/kategori/postkategori','KategoriController@store')->name('storekategori');
Route::post('/kategori/updatekategori','KategoriController@update')->name('updatekategori');
Route::post('/kategori/deletekategori','KategoriController@destroy')->name('deletekategori');

// Produk Route
Route::get('/produk','ProdukController@index');
Route::get('/produk/loadproduk','ProdukController@loadproduk')->name('loadproduk');
Route::post('/produk/postproduk','ProdukController@store')->name('storeproduk');
Route::post('/produk/updateproduk','ProdukController@update')->name('updateproduk');
Route::post('/produk/deleteproduk','ProdukController@destroy')->name('deleteproduk');
