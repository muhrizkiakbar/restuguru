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

Route::get('/transaksi','TransaksiController@transaksi');
Route::get('/transaksi/deleted','TransaksiController@transaksideleted');
Route::post('/transaksi/deleted','TransaksiController@transaksideleted')->name('transaksideletedpost');
Route::get('/transaksi/report/{id}','TransaksiController@report');
Route::get('/transaksi/piutang','TransaksiController@piutang');
Route::get('/transaksi/piutang/angsuran','TransaksiController@angsuranpiutang');
Route::get('/transaksi/piutang/angsuran/deleted','TransaksiController@angsuranpiutangdeleted');
Route::get('/transaksi/pelanggan/cari','TransaksiController@pelanggancari')->name('pelanggancari');
Route::get('/transaksi/pelanggan/cari/detail','TransaksiController@pelanggandetail')->name('pelanggandetail');
Route::get('/transaksi/pelanggan/produk','TransaksiController@priceprodukkhusus')->name('priceprodukkhusus');
Route::post('/transaksi/store','TransaksiController@store')->name('storetransaksi');
//list transaksi
Route::get('/transaksi/list','TransaksiController@listtransaksi');
Route::post('/transaksi/list','TransaksiController@listtransaksi')->name('transaksilist');
Route::get('/trasaksi/list/spesific','TransaksiController@datatransaksispesific')->name('datatransaksispesific');
Route::get('/trasaksi/list/spesific/subtransaksi','TransaksiController@showsubtransaksi')->name('showsubtransaksi');
Route::get('/transaksi/list/edit/{id}','TransaksiController@show')->name('edittransaksi');
Route::post('/transaksi/list/edit','TransaksiController@update')->name('updatetransaksi');
Route::post('/trasaksi/list/destroy','TransaksiController@destroytransaksi')->name('destroytransaksi');


###
Route::get('/transaksi/angsuran','AngsuranPenjualanController@index');
Route::post('/transaksi/angsuran','AngsuranPenjualanController@index')->name('angsuranpenjualan');
Route::get('/transaksi/angsuran/show','AngsuranPenjualanController@showangsuran')->name('showangsuranpenjualan');
Route::post('/transaksi/angsuran/add','AngsuranPenjualanController@store')->name('storeangsuran');
Route::post('/transaksi/angsuran/delete','AngsuranPenjualanController@destroy')->name('destroyangsuran');
Route::get('/transaksi/angsuran/report/detail/{id}','AngsuranPenjualanController@reportdetail')->name('reportdetail');
Route::get('/transaksi/angsuran/report/{id}','AngsuranPenjualanController@reportangsuran')->name('reportangsuran');
Route::get('/transaksi/angsuran/deleted','AngsuranPenjualanController@indexdeleted');
Route::post('/transaksi/angsuran/deleted','AngsuranPenjualanController@indexdeleted')->name('indexdeletedpost');


Route::get('transaksi/pengeluaran','PengeluaranController@index');

// Jenis Pengeluaran
Route::get('transaksi/pengeluaran/jenispengeluaran','PengeluaranController@jenispengeluaran_index');
Route::get('transaksi/pengeluaran/jenispengeluaran/load','PengeluaranController@loadjenispengeluaran')->name('loadjenispengeluaran');
Route::post('transaksi/pengeluaran/jenispengeluaran/store','PengeluaranController@storejenispengeluaran')->name('storejenispengeluaran');
Route::post('transaksi/pengeluaran/jenispengeluaran/update','PengeluaranController@updatejenispengeluaran')->name('updatejenispengeluaran');
Route::post('transaksi/pengeluaran/jenispengeluaran/delete','PengeluaranController@deletejenispengeluaran')->name('deletejenispengeluaran');

Route::get('/produk/cari','ProdukController@produkcari')->name('produkcari');
Route::get('/produk/harga','ProdukController@produkharga')->name('produkharga');
Route::get('/produk/data','ProdukController@dataproduk')->name('dataproduk');

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
Route::get('/jenispelanggan/cari','JenispelangganController@jenispelanggancari')->name('jenispelanggancari');

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

// Supplier Route
Route::get('/supplier','SupplierController@index');
Route::get('/supplier/loadsupplier','SupplierController@loadsupplier')->name('loadsupplier');
Route::post('/supplier/postsupplier','SupplierController@store')->name('storesupplier');
Route::post('/supplier/updatesupplier','SupplierController@update')->name('updatesupplier');
Route::post('/supplier/deletesupplier','SupplierController@destroy')->name('deletesupplier');

// Pelanggan Route
Route::get('/pelanggan','PelangganController@index');
Route::post('/pelanggan/postpelanggan','PelangganController@store')->name('storepelanggan');
Route::get('/pelanggan/loaddatapelanggan','PelangganController@datapelanggan')->name('loaddatapelanggan');
Route::post('/pelanggan/updatepelanggan','PelangganController@update')->name('updatepelanggan');
Route::post('/pelanggan/deletepelanggan','PelangganController@destroy')->name('deletepelanggan');

// Special Price Route
Route::get('/specialprice','SpecialPriceController@index');
Route::get('/specialprice/loadspecialprice','SpecialPriceController@loadspecialprice')->name('loadspecialprice');
Route::post('/specialprice/postspecialprice','SpecialPriceController@store')->name('storespecialprice');
Route::post('/specialprice/updatespecialprice','SpecialPriceController@update')->name('updatespecialprice');
Route::post('/specialprice/deletespecialprice','SpecialPriceController@destroy')->name('deletespecialprice');
//SpecialPriceGroup
Route::get('/specialpricegroup','SpecialpricegroupController@index');
Route::post('/specialpricegroup/postspg','SpecialpricegroupController@store')->name('storespg');
Route::get('/specialpricegroup/loaddata','SpecialpricegroupController@loaddatatable')->name('loaddata');
Route::post('/specialpricegroup/updatespg','SpecialpricegroupController@update')->name('updatespg');
Route::post('/specialpricegroup/deletespg','SpecialpricegroupController@destroy')->name('deletespg');
