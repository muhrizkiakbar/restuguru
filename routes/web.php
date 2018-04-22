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

Route::get('/login', function () {
    return view('login');
});

// User Route
Route::get('/users','UserController@index');
Route::get('/users/dataalluser','UserController@dataalluser')->name('dataalluser');
Route::post('/users/postuser','UserController@store')->name('storeuser');
Route::post('/users/updateuser','UserController@update')->name('updateuser');
Route::post('/users/deleteuser','UserController@destroy')->name('deleteuser');

Route::post('/users/updateuser','UserController@update')->name('updateuser');
Route::post('/users/deleteuser','UserController@destroy')->name('deleteuser');

Route::get('/roles','RoleController@index');
Route::get('/roles/data','RoleController@data')->name('datarole');
Route::get('/roles/add','RoleController@create')->name('addrole');
Route::post('/roles/add','RoleController@store')->name('storerole');
Route::get('/roles/edit/{id}','RoleController@show')->name('showrole');
Route::put('/roles/edit/{id}','RoleController@update')->name('updaterole');
Route::post('/roles/delete','RoleController@destroy')->name('destroyrole');

Route::get('/transaksi','TransaksiController@index');

Auth::routes();

Route::group(['middleware' => 'auth'], function() {

    

    // Cabang Route
    Route::get('/cabang','CabangController@index');
    Route::get('/cabang/loaddatacabang','CabangController@loaddatacabang')->name('loaddatacabang');
    Route::post('/cabang/postcabang','CabangController@store')->name('storecabang');
    Route::post('/cabang/updatecabang','CabangController@update')->name('updatecabang');
    Route::post('/cabang/deletecabang','CabangController@destroy')->name('deletecabang');


    Route::get('/home', 'HomeController@index')->name('home');

});
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
