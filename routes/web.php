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

Route::post('/','LoginController@postLogin');
Route::post('/login','LoginController@postLogin');


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

    // User Route
    Route::get('/users',['middleware' => ['permission:manage-users'], 'uses' => 'UserController@index'])->name('userindex');
    Route::get('/users/dataalluser',['middleware' => ['permission:manage-users'], 'uses' => 'UserController@dataalluser'])->name('dataalluser');
    Route::post('/users/postuser',['middleware' => ['permission:add-users'], 'uses' => 'UserController@store'])->name('storeuser');
    Route::post('/users/updateuser',['middleware' => ['permission:edit-users'], 'uses' => 'UserController@update'])->name('updateuser');
    Route::post('/users/deleteuser',['middleware' => ['permission:delete-users'], 'uses' => 'UserController@destroy'])->name('deleteuser');

    Route::get('/roles',['middleware' => ['permission:manage-roles'], 'uses' => 'RoleController@index'])->name('roleindex');
    Route::get('/roles/data',['middleware' => ['permission:manage-roles'], 'uses' => 'RoleController@data'])->name('datarole');
    Route::get('/roles/add',['middleware' => ['permission:manage-roles'], 'uses' => 'RoleController@create'])->name('addrole');
    Route::post('/roles/add',['middleware' => ['permission:add-roles'], 'uses' => 'RoleController@store'])->name('storerole');
    Route::get('/roles/edit/{id}',['middleware' => ['permission:edit-roles'], 'uses' => 'RoleController@show'])->name('showrole');
    Route::put('/roles/edit/{id}',['middleware' => ['permission:edit-roles'], 'uses' => 'RoleController@update'])->name('updaterole');
    Route::post('/roles/delete',['middleware' => ['permission:delete-roles'], 'uses' => 'RoleController@destroy'])->name('destroyrole');

    Route::get('/transaksi',['middleware' => ['permission:add-transaksipenjualan'], 'uses' => 'TransaksiController@transaksi'])->name('addtransaksiindex');
    Route::post('/transaksi/store',['middleware' => ['permission:add-transaksipenjualan'], 'uses' => 'TransaksiController@store'])->name('storetransaksi');
    Route::get('/transaksi/list/edit/{id}',['middleware' => ['permission:edit-transaksipenjualan'], 'uses' => 'TransaksiController@show'])->name('edittransaksi');
    Route::post('/transaksi/list/edit',['middleware' => ['permission:edit-transaksipenjualan'], 'uses' => 'TransaksiController@update'])->name('updatetransaksi');
    Route::post('/trasaksi/list/destroy',['middleware' => ['permission:delete-transaksipenjualan'], 'uses' => 'TransaksiController@destroytransaksi'])->name('destroytransaksi');
    Route::get('/produk/cari',['middleware' => ['permission:add-transaksipenjualan|edit-transaksipenjualan'], 'uses' => 'ProdukController@produkcari'])->name('produkcari');
    Route::get('/produk/harga',['middleware' => ['permission:add-transaksipenjualan|edit-transaksipenjualan'], 'uses' => 'ProdukController@produkharga'])->name('produkharga');
    Route::get('/produk/data',['middleware' => ['permission:add-transaksipenjualan|edit-transaksipenjualan'], 'uses' => 'ProdukController@dataproduk'])->name('dataproduk');

    //list transaksi
    Route::get('/transaksi/list',['middleware' => ['permission:manage-transaksipenjualan'], 'uses' => 'TransaksiController@listtransaksi'])->name('transaksipenjualanmanageindex');
    Route::post('/transaksi/list',['middleware' => ['permission:manage-transaksipenjualan'], 'uses' => 'TransaksiController@listtransaksi'])->name('transaksilist');
    Route::get('/trasaksi/list/spesific',['middleware' => ['permission:manage-transaksipenjualan'], 'uses' => 'TransaksiController@datatransaksispesific'])->name('datatransaksispesific');
    Route::get('/trasaksi/list/spesific/subtransaksi',['middleware' => ['permission:manage-transaksipenjualan'], 'uses' => 'TransaksiController@showsubtransaksi'])->name('showsubtransaksi');

    Route::get('/transaksi/deleted',['middleware' => ['permission:deleted-transaksipenjualan'], 'uses' => 'TransaksiController@transaksideleted'])->name('transaksipenjualandeletedindex');
    Route::post('/transaksi/deleted',['middleware' => ['permission:deleted-transaksipenjualan'], 'uses' => 'TransaksiController@transaksideleted'])->name('transaksideletedpost');



    //global route nya
    Route::get('/transaksi/pelanggan/cari',['middleware' => ['permission:manage-transaksipenjualan|add-transaksipenjualan|manage-angsuran|deleted-transaksipenjualan'], 'uses' => 'TransaksiController@pelanggancari'])->name('pelanggancari');
    Route::get('/transaksi/pelanggan/cari/detail',['middleware' => ['permission:manage-transaksipenjualan|add-transaksipenjualan|manage-angsuran|deleted-transaksipenjualan'], 'uses' => 'TransaksiController@pelanggandetail'])->name('pelanggandetail');
    Route::get('/transaksi/pelanggan/produk',['middleware' => ['permission:manage-transaksipenjualan|add-transaksipenjualan|manage-angsuran|deleted-transaksipenjualan'], 'uses' => 'TransaksiController@priceprodukkhusus'])->name('priceprodukkhusus');



    ###
    Route::get('/transaksi/angsuran/list',['middleware' => ['permission:list-angsuranpenjualan'], 'uses' => 'AngsuranPenjualanController@angsuranlist'])->name('listangsuranpenjualanindex');
    Route::post('/transaksi/angsuran/list',['middleware' => ['permission:list-angsuranpenjualan'], 'uses' => 'AngsuranPenjualanController@angsuranlist'])->name('listangsuranpenjualan');

    Route::get('/transaksi/angsuran',['middleware' => ['permission:manage-angsuranpenjualan'], 'uses' => 'AngsuranPenjualanController@index'])->name('angsuranpenjualanindex');
    Route::post('/transaksi/angsuran',['middleware' => ['permission:manage-angsuranpenjualan'], 'uses' => 'AngsuranPenjualanController@index'])->name('angsuranpenjualan');
    Route::get('/transaksi/angsuran/show',['middleware' => ['permission:manage-angsuranpenjualan|manage-transaksipenjualan'], 'uses' => 'AngsuranPenjualanController@showangsuran'])->name('showangsuranpenjualan');
    Route::post('/transaksi/angsuran/add',['middleware' => ['permission:add-angsuranpenjualan'], 'uses' => 'AngsuranPenjualanController@store'])->name('storeangsuran');
    Route::post('/transaksi/angsuran/delete',['middleware' => ['permission:delete-angsuranpenjualan'], 'uses' => 'AngsuranPenjualanController@destroy'])->name('destroyangsuran');
    Route::get('/transaksi/angsuran/report/detail/{id}','AngsuranPenjualanController@reportdetail')->name('reportdetail');
    Route::get('/transaksi/angsuran/report/{id}',['middleware' => ['permission:report-angsuranpenjualan'], 'uses' => 'AngsuranPenjualanController@reportangsuran'])->name('reportangsuran');
    Route::get('/transaksi/angsuran/deleted',['middleware' => ['permission:deleted-angsuranpenjualan'], 'uses' => 'AngsuranPenjualanController@indexdeleted'])->name('angsuranpenjualandeletedindex');
    Route::post('/transaksi/angsuran/deleted',['middleware' => ['permission:deleted-angsuranpenjualan'], 'uses' => 'AngsuranPenjualanController@indexdeleted'])->name('indexdeletedpost');


    Route::get('/transaksi/pengeluaran',['middleware' => ['permission:add-transaksipengeluaran'], 'uses' => 'PengeluaranController@index'])->name('addtransaksipengeluaranindex');
    Route::get('/transaksi/pengeluaran/searchjenispengeluaran',['middleware' => ['permission:manage-transaksipengeluaran|add-transaksipengeluaran|edit-transaksipengeluaran'], 'uses' => 'PengeluaranController@jenispengeluaransearch'])->name('jenispengeluaransearch');
    Route::get('/transaksi/pengeluaran/users/search',['middleware' => ['permission:manage-transaksipengeluaran|add-transaksipengeluaran|edit-transaksipengeluaran'], 'uses' => 'PengeluaranController@userssearch'])->name('searchusers');
    Route::get('/transaksi/pengeluaran/users/search/detail',['middleware' => ['permission:manage-transaksipengeluaran|add-transaksipengeluaran|edit-transaksipengeluaran'], 'uses' => 'PengeluaranController@usersearchdetail'])->name('searchdetailusers');
    Route::get('/transaksi/pengeluaran/suppliers/search',['middleware' => ['permission:manage-transaksipengeluaran|add-transaksipengeluaran|edit-transaksipengeluaran'], 'uses' => 'PengeluaranController@suppliersearch'])->name('suppliersearch');
    Route::get('/transaksi/pengeluaran/suppliers/search/detail',['middleware' => ['permission:manage-transaksipengeluaran|add-transaksipengeluaran|edit-transaksipengeluaran'], 'uses' => 'PengeluaranController@suppliersearchdetail'])->name('suppliersearchdetail');
    Route::post('/transaksi/pengeluaran/store',['middleware' => ['permission:add-transaksipengeluaran'], 'uses' => 'PengeluaranController@store'])->name('storetransaksipengeluaran');
    Route::get('/transaksi/pengeluaran/report/{id}',['middleware' => ['permission:report-transaksipengeluaran'], 'uses' => 'PengeluaranController@reporttranspengeluaran']);
    Route::get('/transaksi/pengeluaran/list',['middleware' => ['permission:manage-transaksipengeluaran'], 'uses' => 'PengeluaranController@listtransaksi'])->name('managetransaksipengeluaranindex');
    Route::post('/transaksi/pengeluaran/list',['middleware' => ['permission:manage-transaksipengeluaran'], 'uses' => 'PengeluaranController@listtransaksi'])->name('transaksipengeluaran');
    Route::get('/transaksi/pengeluaran/list/{id}',['middleware' => ['permission:edit-transaksipengeluaran'], 'uses' => 'PengeluaranController@show']);
    Route::post('/transaksi/pengeluaran/list/edit',['middleware' => ['permission:edit-transaksipengeluaran'], 'uses' => 'PengeluaranController@update'])->name('updatetransaksipengeluaran');
    Route::get('/transaksi/pengeluaran/subtrans/detail',['middleware' => ['permission:manage-transaksipengeluaran'], 'uses' => 'PengeluaranController@showsubtransaksipengeluaran'])->name('showsubtransaksipengeluaran');
    Route::get('/transaksi/pengeluaran/delete/detail',['middleware' => ['permission:manage-transaksipengeluaran'], 'uses' => 'PengeluaranController@datatransaksipengeluaranspesific'])->name('datatransaksipengeluaranspesific');
    Route::post('/transaksi/pengeluaran/delete',['middleware' => ['permission:delete-transaksipengeluaran'], 'uses' => 'PengeluaranController@destroytransaksipengeluaran'])->name('destroytransaksipengeluaran');
    Route::get('/transaksi/pengeluaran/deleted',['middleware' => ['permission:deleted-transaksipengeluaran'], 'uses' => 'PengeluaranController@pengeluarandeleted'])->name('pengeluarandeletedindex');
    Route::post('/transaksi/pengeluaran/deleted',['middleware' => ['permission:deleted-transaksipengeluaran'], 'uses' => 'PengeluaranController@pengeluarandeleted'])->name('pengeluarandeleted');

    Route::get('/transaksi/pengeluaran/angsuran/list',['middleware' => ['permission:list-angsuranpengeluaran'], 'uses' => 'AngsuranPengeluaranController@angsuranlist'])->name('listangsuranpengeluaranindex');
    Route::post('/transaksi/pengeluaran/angsuran/list',['middleware' => ['permission:list-angsuranpengeluaran'], 'uses' => 'AngsuranPengeluaranController@angsuranlist'])->name('listangsuranpengeluaran');
    
    Route::get('/transaksi/pengeluaran/angsuran',['middleware' => ['permission:manage-angsuranpengeluaran'], 'uses' => 'AngsuranPengeluaranController@index'])->name('manageangsuranpengeluaranindex');
    Route::post('/transaksi/pengeluaran/angsuran',['middleware' => ['permission:manage-angsuranpengeluaran'], 'uses' => 'AngsuranPengeluaranController@index'])->name('angsuranpengeluaran');
    Route::get('/transaksi/pengeluaran/angsuran/show',['middleware' => ['permission:manage-angsuranpengeluaran|manage-transaksipengeluaran'], 'uses' => 'AngsuranPengeluaranController@showangsuran'])->name('showangsuranpengeluaran');
    Route::post('/transaksi/pengeluaran/angsuran/store',['middleware' => ['permission:add-angsuranpengeluaran'], 'uses' => 'AngsuranPengeluaranController@store'])->name('storeangsuranpengeluaran');
    Route::post('/transaksi/pengeluaran/angsuran/delete',['middleware' => ['permission:delete-angsuranpengeluaran'], 'uses' => 'AngsuranPengeluaranController@destroy'])->name('destroyangsuranpengeluaran');
    Route::get('/transaksi/pengeluaran/angsuran/report/{id}',['middleware' => ['permission:report-angsuranpengeluaran'], 'uses' => 'AngsuranPengeluaranController@reportangsuran']);
    Route::get('/transaksi/pengeluaran/angsuran/report/detail/{id}',['middleware' => ['permission:report-angsuranpengeluarandetail'], 'uses' => 'AngsuranPengeluaranController@reportdetail']);


    // Cabang Route
    Route::get('/cabang',['middleware' => ['permission:manage-cabang'], 'uses' => 'CabangController@index'])->name('managecabangindex');
    Route::get('/cabang/loaddatacabang',['middleware' => ['permission:manage-cabang'], 'uses' => 'CabangController@loaddatacabang'])->name('loaddatacabang');
    Route::post('/cabang/postcabang',['middleware' => ['permission:add-cabang'], 'uses' => 'CabangController@store'])->name('storecabang');
    Route::post('/cabang/updatecabang',['middleware' => ['permission:edit-cabang'], 'uses' => 'CabangController@update'])->name('updatecabang');
    Route::post('/cabang/deletecabang',['middleware' => ['permission:delete-cabang'], 'uses' => 'CabangController@destroy'])->name('deletecabang');

    //Home
    Route::get('/home',['middleware' => ['permission:index-home'], 'uses' => 'DashboardController@index'])->name('home');
    Route::get('/home/piedata',['middleware' => ['permission:index-home'], 'uses' => 'DashboardController@piedata'])->name('piedata');
    Route::get('/home/linedata',['middleware' => ['permission:index-home'], 'uses' => 'DashboardController@linedata'])->name('linedata');

    //Laporan
    Route::get('/laporan','LaporanController@index')->name('laporan');
    Route::get('/laporan/filter','LaporanController@filter')->name('filter');
    Route::get('/laporan/chart','LaporanController@linedatalaporan')->name('chartlaporan');

    // Jenis Pelanggan Route
    Route::get('/jenispelanggan',['middleware' => ['permission:manage-pelanggan'], 'uses' => 'JenispelangganController@index'])->name('managepelangganindex');
    Route::get('/jenispelanggan/loadjenispelanggan',['middleware' => ['permission:manage-pelanggan'], 'uses' => 'JenispelangganController@loadjenispelanggan'])->name('loadjenispelanggan');
    Route::post('/jenispelanggan/postjenispelanggan',['middleware' => ['permission:add-pelanggan'], 'uses' => 'JenispelangganController@store'])->name('storejenispelanggan');
    Route::post('/jenispelanggan/updatejenispelanggan',['middleware' => ['permission:edit-pelanggan'], 'uses' => 'JenispelangganController@update'])->name('updatejenispelanggan');
    Route::post('/jenispelanggan/deletejenispelanggan',['middleware' => ['permission:delete-pelanggan'], 'uses' => 'JenispelangganController@destroy'])->name('deletejenispelanggan');

    // Kategori Route
    Route::get('/kategori',['middleware' => ['permission:manage-kategori'], 'uses' => 'KategoriController@index'])->name('managekategoriindex');
    Route::get('/kategori/loadkategori',['middleware' => ['permission:manage-kategori'], 'uses' => 'KategoriController@loadkategori'])->name('loadkategori');
    Route::post('/kategori/postkategori',['middleware' => ['permission:add-kategori'], 'uses' => 'KategoriController@store'])->name('storekategori');
    Route::post('/kategori/updatekategori',['middleware' => ['permission:edit-kategori'], 'uses' => 'KategoriController@update'])->name('updatekategori');
    Route::post('/kategori/deletekategori',['middleware' => ['permission:delete-kategori'], 'uses' => 'KategoriController@destroy'])->name('deletekategori');

    // Produk Route
    Route::get('/produk', ['middleware' => ['permission:manage-produk'], 'uses' => 'ProdukController@index'])->name('manageprodukindex');
    Route::get('/produk/loadproduk',['middleware' => ['permission:manage-produk'], 'uses' => 'ProdukController@loadproduk'])->name('loadproduk');
    Route::post('/produk/postproduk',['middleware' => ['permission:add-produk'], 'uses' => 'ProdukController@store'])->name('storeproduk');
    Route::post('/produk/updateproduk',['middleware' => ['permission:edit-produk'], 'uses' => 'ProdukController@update'])->name('updateproduk');
    Route::post('/produk/deleteproduk',['middleware' => ['permission:delete-produk'], 'uses' => 'ProdukController@destroy'])->name('deleteproduk');

    // Supplier Route
    Route::get('/supplier',['middleware' => ['permission:manage-supplier'], 'uses' => 'SupplierController@index'])->name('managesupplierindex');
    Route::get('/supplier/loadsupplier',['middleware' => ['permission:manage-supplier'], 'uses' => 'SupplierController@loadsupplier'])->name('loadsupplier');
    Route::post('/supplier/postsupplier',['middleware' => ['permission:add-supplier'], 'uses' => 'SupplierController@store'])->name('storesupplier');
    Route::post('/supplier/updatesupplier',['middleware' => ['permission:edit-supplier'], 'uses' => 'SupplierController@update'])->name('updatesupplier');
    Route::post('/supplier/deletesupplier',['middleware' => ['permission:delete-supplier'], 'uses' => 'SupplierController@destroy'])->name('deletesupplier');
    // Pelanggan Route
    Route::get('/pelanggan',['middleware' => ['permission:manage-pelanggan'], 'uses' => 'PelangganController@index']);
    Route::post('/pelanggan/postpelanggan',['middleware' => ['permission:add-pelanggan'], 'uses' => 'PelangganController@store'])->name('storepelanggan');
    Route::get('/pelanggan/loaddatapelanggan',['middleware' => ['permission:manage-pelanggan'], 'uses' => 'PelangganController@datapelanggan'])->name('loaddatapelanggan');
    Route::post('/pelanggan/updatepelanggan',['middleware' => ['permission:edit-pelanggan'], 'uses' => 'PelangganController@update'])->name('updatepelanggan');
    Route::post('/pelanggan/deletepelanggan',['middleware' => ['permission:delete-pelanggan'], 'uses' => 'PelangganController@destroy'])->name('deletepelanggan');

    Route::get('/ubahpassword','UserController@indexchangepassword');
    Route::post('/ubahpassword','UserController@changepassword');
    Route::get('/logout',function (){
        Auth::logout();
        return redirect('/')->with('error', 'Logout Berhasil');
    });

});
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
