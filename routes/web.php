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


Route::get('/login','Auth\LoginController@index');

Route::get('/','Auth\LoginController@index');

        

Route::post('/','Auth\LoginController@postLogin');
Route::post('/login','Auth\LoginController@postLogin');



// Route::get('/transaksi/angsuran/tagihan','AngsuranPenjualanController@daftartagih')->name('penagihanpenjualanindex');


Route::get('/transaksi/report/{id}','TransaksiController@report');
Route::get('/transaksi/report_to_image/{id}','TransaksiController@report_to_image');


Route::post('/YHr1bq5qGFPYBzaWYc51ajt0sIQ2DcGQhNkPKMSjZ0DPzMLJlOOGUXxX0mbYZKxxF3ihX5dkMLtKo3t1JgJNSjhn6hv6ZqlryPBZcwNL2NsKrcQ8F3kMXRW8kCG64Nbd/webhook', function () {
  $update = Telegram::commandsHandler(true);
});


Auth::routes();

Route::group(['middleware' => 'auth'], function() {
    
        

        Route::post('setwebhook', function(){
          $response = Telegram::setWebhook(['url' => 'https://promosindo.restuguru.com/YHr1bq5qGFPYBzaWYc51ajt0sIQ2DcGQhNkPKMSjZ0DPzMLJlOOGUXxX0mbYZKxxF3ihX5dkMLtKo3t1JgJNSjhn6hv6ZqlryPBZcwNL2NsKrcQ8F3kMXRW8kCG64Nbd/webhook']);
          dd($response);
        });

        Route::post('deletewebhook', function(){
          $response = Telegram::removeWebhook();
          dd($response);
        });


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
        Route::get('/transaksi/edit/{id}',['middleware' => ['permission:edit-transaksipenjualan'], 'uses' => 'TransaksiController@edit'])->name('edittransaksi');
        Route::post('/transaksi/edit/{id}',['middleware' => ['permission:edit-transaksipenjualan'], 'uses' => 'TransaksiController@update'])->name('updatetransaksi');
        Route::post('/trasaksi/list/destroy',['middleware' => ['permission:delete-transaksipenjualan'], 'uses' => 'TransaksiController@destroytransaksi'])->name('destroytransaksi');
        Route::get('/produk/cari',['middleware' => ['permission:add-transaksipenjualan|edit-transaksipenjualan'], 'uses' => 'ProdukController@produkcari'])->name('produkcari');
        Route::get('/produk/harga',['middleware' => ['permission:add-transaksipenjualan|edit-transaksipenjualan'], 'uses' => 'ProdukController@produkharga'])->name('produkharga');
        Route::get('/produk/data',['middleware' => ['permission:add-transaksipenjualan|edit-transaksipenjualan'], 'uses' => 'ProdukController@dataproduk'])->name('dataproduk');

        //list transaksi
        Route::get('/transaksi/list',['middleware' => ['permission:manage-transaksipenjualan'], 'uses' => 'TransaksiController@listtransaksi'])->name('transaksipenjualanmanageindex');
        Route::post('/transaksi/list',['middleware' => ['permission:manage-transaksipenjualan'], 'uses' => 'TransaksiController@listtransaksi'])->name('transaksilist');
        Route::post('/transaksi/list/export',['middleware' => ['permission:manage-transaksipenjualan'], 'uses' => 'TransaksiController@exporttransaksi'])->name('transaksilistexport');

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
        Route::post('/transaksi/angsuran/export',['middleware' => ['permission:manage-angsuranpenjualan'], 'uses' => 'AngsuranPenjualanController@exportangsuran'])->name('angsuranlistexport');

        Route::post('/transaksi/angsuran/add/all',['middleware' => ['permission:add-angsuranpenjualan'], 'uses' => 'AngsuranPenjualanController@storeall'])->name('angsuranpenjualanstoreall');

        Route::post('/transaksi/angsuran/add',['middleware' => ['permission:add-angsuranpenjualan'], 'uses' => 'AngsuranPenjualanController@store'])->name('storeangsuran');
        Route::post('/transaksi/angsuran/delete',['middleware' => ['permission:delete-angsuranpenjualan'], 'uses' => 'AngsuranPenjualanController@destroy'])->name('destroyangsuran');
        Route::get('/transaksi/angsuran/report/detail/{id}',['middleware' => ['permission:report-angsuranpenjualandetail'], 'uses' => 'AngsuranPenjualanController@reportdetail'])->name('reportdetail');
        Route::get('/transaksi/angsuran/report/{id}',['middleware' => ['permission:report-angsuranpenjualan'], 'uses' => 'AngsuranPenjualanController@reportangsuran'])->name('reportangsuran');
        Route::get('/transaksi/angsuran/deleted',['middleware' => ['permission:deleted-angsuranpenjualan'], 'uses' => 'AngsuranPenjualanController@angsurandeleted'])->name('angsuranpenjualandeletedindex');
        Route::post('/transaksi/angsuran/deleted',['middleware' => ['permission:deleted-angsuranpenjualan'], 'uses' => 'AngsuranPenjualanController@angsurandeleted'])->name('indexdeletedpost');


        Route::get('/transaksi/pengeluaran',['middleware' => ['permission:add-transaksipengeluaran'], 'uses' => 'PengeluaranController@index'])->name('addtransaksipengeluaranindex');
        Route::get('/transaksi/pengeluaran/bahanbaku',['middleware' => ['permission:add-transaksipengeluaran'], 'uses' => 'BahanBakuController@bahanbakucari'])->name('bahanbakucari');

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
        Route::post('/transaksi/pengeluaran/exportpengeluaran',['middleware' => ['permission:manage-transaksipengeluaran'], 'uses' => 'PengeluaranController@exporttransaksi'])->name('transaksilistexport');

        Route::get('/transaksi/pengeluaran/angsuran/list',['middleware' => ['permission:list-angsuranpengeluaran'], 'uses' => 'AngsuranPengeluaranController@angsuranlist'])->name('listangsuranpengeluaranindex');
        Route::post('/transaksi/pengeluaran/angsuran/list',['middleware' => ['permission:list-angsuranpengeluaran'], 'uses' => 'AngsuranPengeluaranController@angsuranlist'])->name('listangsuranpengeluaran');

        Route::get('/transaksi/pengeluaran/angsuran',['middleware' => ['permission:manage-angsuranpengeluaran'], 'uses' => 'AngsuranPengeluaranController@index'])->name('manageangsuranpengeluaranindex');
        Route::post('/transaksi/pengeluaran/angsuran',['middleware' => ['permission:manage-angsuranpengeluaran'], 'uses' => 'AngsuranPengeluaranController@index'])->name('angsuranpengeluaran');
        Route::get('/transaksi/pengeluaran/angsuran/show',['middleware' => ['permission:manage-angsuranpengeluaran|manage-transaksipengeluaran'], 'uses' => 'AngsuranPengeluaranController@showangsuran'])->name('showangsuranpengeluaran');
        Route::post('/transaksi/pengeluaran/angsuran/store',['middleware' => ['permission:add-angsuranpengeluaran'], 'uses' => 'AngsuranPengeluaranController@store'])->name('storeangsuranpengeluaran');
        Route::post('/transaksi/pengeluaran/angsuran/delete',['middleware' => ['permission:delete-angsuranpengeluaran'], 'uses' => 'AngsuranPengeluaranController@destroy'])->name('destroyangsuranpengeluaran');
        Route::get('/transaksi/pengeluaran/angsuran/deleted',['middleware' => ['permission:deleted-angsuranpengeluaran'], 'uses' => 'AngsuranPengeluaranController@angsurandeleted'])->name('deletedangsuranpengeluaranindex');
        Route::post('/transaksi/pengeluaran/angsuran/deleted',['middleware' => ['permission:deleted-angsuranpengeluaran'], 'uses' => 'AngsuranPengeluaranController@angsurandeleted'])->name('deletedangsuranpengeluaran');
        Route::get('/transaksi/pengeluaran/angsuran/report/{id}',['middleware' => ['permission:report-angsuranpengeluaran'], 'uses' => 'AngsuranPengeluaranController@reportangsuran']);
        Route::get('/transaksi/pengeluaran/angsuran/report/detail/{id}',['middleware' => ['permission:report-angsuranpengeluarandetail'], 'uses' => 'AngsuranPengeluaranController@reportdetail']);
        // Jenis Pengeluaran
        Route::get('transaksi/pengeluaran/jenispengeluaran',['middleware'=> ['permission:manage-jenispengeluaran'],'uses' =>'PengeluaranController@jenispengeluaran_index'])->name('jenispengeluaranindex');
        Route::get('transaksi/pengeluaran/jenispengeluaran/load',['middleware'=> ['permission:manage-jenispengeluaran'],'uses' =>'PengeluaranController@loadjenispengeluaran'])->name('loadjenispengeluaran');
        Route::post('transaksi/pengeluaran/jenispengeluaran/store',['middleware'=> ['permission:store-jenispengeluaran'],'uses' =>'PengeluaranController@storejenispengeluaran'])->name('storejenispengeluaran');
        Route::post('transaksi/pengeluaran/jenispengeluaran/update',['middleware'=> ['permission:edit-jenispengeluaran'],'uses' =>'PengeluaranController@updatejenispengeluaran'])->name('updatejenispengeluaran');
        Route::post('transaksi/pengeluaran/jenispengeluaran/delete',['middleware'=> ['permission:destroy-jenispengeluaran'],'uses' =>'PengeluaranController@deletejenispengeluaran'])->name('deletejenispengeluaran');



        // Cabang Route
        Route::get('/cabang',['middleware' => ['permission:manage-cabang'], 'uses' => 'CabangController@index'])->name('managecabangindex');
        Route::get('/cabang/loaddatacabang',['middleware' => ['permission:manage-cabang'], 'uses' => 'CabangController@loaddatacabang'])->name('loaddatacabang');
        Route::post('/cabang/postcabang',['middleware' => ['permission:add-cabang'], 'uses' => 'CabangController@store'])->name('storecabang');
        Route::post('/cabang/updatecabang',['middleware' => ['permission:edit-cabang'], 'uses' => 'CabangController@update'])->name('updatecabang');
        Route::post('/cabang/deletecabang',['middleware' => ['permission:delete-cabang'], 'uses' => 'CabangController@destroy'])->name('deletecabang');

        Route::get('/home',['middleware' => ['permission:index-home'], 'uses' => 'DashboardController@index'])->name('homeindex');
        Route::get('/home/piedata',['middleware' => ['permission:index-home'], 'uses' => 'DashboardController@piedata'])->name('piedata');
        Route::get('/home/linedata',['middleware' => ['permission:index-home'], 'uses' => 'DashboardController@linedata'])->name('linedata');
        Route::get('/jatuhtempo',['middleware'=>['permission:index-home'],'uses'=>'TransaksiController@jatuhtempo'])->name('jatuhtempoindex');
        Route::get('/jatuhtempo/cari',['middleware'=>['permission:index-home'],'uses'=>'TransaksiController@jatuhtempocari'])->name('jatuhtempocari');

        // Jenis Pelanggan Route
        Route::get('/jenispelanggan',['middleware' => ['permission:manage-jenispelanggan'], 'uses' => 'JenispelangganController@index'])->name('managejenispelangganindex');
        Route::get('/jenispelanggan/loadjenispelanggan',['middleware' => ['permission:manage-jenispelanggan'], 'uses' => 'JenispelangganController@loadjenispelanggan'])->name('loadjenispelanggan');
        Route::post('/jenispelanggan/postjenispelanggan',['middleware' => ['permission:add-jenispelanggan'], 'uses' => 'JenispelangganController@store'])->name('storejenispelanggan');
        Route::post('/jenispelanggan/updatejenispelanggan',['middleware' => ['permission:edit-jenispelanggan'], 'uses' => 'JenispelangganController@update'])->name('updatejenispelanggan');
        Route::post('/jenispelanggan/deletejenispelanggan',['middleware' => ['permission:delete-jenispelanggan'], 'uses' => 'JenispelangganController@destroy'])->name('deletejenispelanggan');

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
        Route::get('/pelanggan',['middleware' => ['permission:manage-pelanggan'], 'uses' => 'PelangganController@index'])->name('managepelangganindex');
        Route::post('/pelanggan/postpelanggan',['middleware' => ['permission:add-pelanggan'], 'uses' => 'PelangganController@store'])->name('storepelanggan');
        Route::get('/pelanggan/loaddatapelanggan',['middleware' => ['permission:manage-pelanggan'], 'uses' => 'PelangganController@datapelanggan'])->name('loaddatapelanggan');
        Route::post('/pelanggan/updatepelanggan',['middleware' => ['permission:edit-pelanggan'], 'uses' => 'PelangganController@update'])->name('updatepelanggan');
        Route::post('/pelanggan/deletepelanggan',['middleware' => ['permission:delete-pelanggan'], 'uses' => 'PelangganController@destroy'])->name('deletepelanggan');

        // Special Price Route
        Route::get('/specialprice',['middleware' => ['permission:manage-specialprice'], 'uses' => 'SpecialPriceController@index'])->name('managespecialprice');
        Route::get('/specialprice/loadspecialprice',['middleware' => ['permission:manage-specialprice'], 'uses' => 'SpecialPriceController@loadspecialprice'])->name('loadspecialprice');
        Route::post('/specialprice/postspecialprice',['middleware' => ['permission:add-specialprice'], 'uses' => 'SpecialPriceController@store'])->name('storespecialprice');
        Route::post('/specialprice/updatespecialprice',['middleware' => ['permission:edit-specialprice'], 'uses' => 'SpecialPriceController@update'])->name('updatespecialprice');
        Route::post('/specialprice/deletespecialprice',['middleware' => ['permission:delete-specialprice'], 'uses' => 'SpecialPriceController@destroy'])->name('deletespecialprice');
        Route::get('/specialprice/{id}/ranges',['middleware' => ['permission:manage-specialprice'], 'uses' => 'RangePricePelangganController@index'])->name('rangespecialprices');
        Route::post('/specialprice/{id}/ranges',['middleware' => ['permission:add-specialprice'], 'uses' => 'RangePricePelangganController@create'])->name('createrangespecialprices');
        Route::delete('/specialprice/{id}/ranges/{range_price_pelanggan_id}',['middleware' => ['permission:delete-specialprice'], 'uses' => 'RangePricePelangganController@destroy'])->name('deleterangespecialprices');
        Route::post('/specialprice/pelanggans/detail',['middleware' => ['permission:manage-specialprice'], 'uses' => 'SpecialPriceController@price_khusus_pelanggans'])->name('price_khusus_pelanggans_detail');
        Route::get('/specialprice/pelanggan/{id}/{produk_id}',['middleware' => ['permission:manage-specialprice'], 'uses' => 'SpecialPriceController@price_khusus_pelanggan'])->name('price_khusus_pelanggan');
        Route::get('/specialprice/pelanggans/new',['middleware' => ['permission:manage-specialprice'], 'uses' => 'SpecialPriceController@new_price_khusus_pelanggans'])->name('new_price_khusus_pelanggans');
        Route::post('/specialprice/pelanggans',['middleware' => ['permission:manage-specialprice'], 'uses' => 'SpecialPriceController@create_price_khusus_pelanggans'])->name('create_price_khusus_pelanggans');


        //SpecialPriceGroup
        Route::get('/specialpricegroup',['middleware' => ['permission:manage-specialpricegroup'], 'uses' => 'SpecialpricegroupController@index'])->name('managespecialpricegroup');
        Route::post('/specialpricegroup/postspg',['middleware' => ['permission:add-specialpricegroup'], 'uses' => 'SpecialpricegroupController@store'])->name('storespg');
        Route::get('/specialpricegroup/loaddata',['middleware' => ['permission:manage-specialpricegroup'], 'uses' => 'SpecialpricegroupController@loaddatatable'])->name('loaddata');
        Route::post('/specialpricegroup/updatespg',['middleware' => ['permission:edit-specialpricegroup'], 'uses' => 'SpecialpricegroupController@update'])->name('updatespg');
        Route::post('/specialpricegroup/deletespg',['middleware' => ['permission:delete-specialpricegroup'], 'uses' => 'SpecialpricegroupController@destroy'])->name('deletespg');
        Route::get('/specialpricegroup/{id}/rangegroups',['middleware' => ['permission:manage-specialprice'], 'uses' => 'RangePriceGroupController@index'])->name('rangespecialpricegroups');
        Route::post('/specialpricegroup/{id}/rangegroups',['middleware' => ['permission:add-specialprice'], 'uses' => 'RangePriceGroupController@create'])->name('createrangespecialgroups');
        Route::delete('/specialpricegroup/{id}/rangegroups/{range_price_group_id}',['middleware' => ['permission:delete-specialprice'], 'uses' => 'RangePriceGroupController@destroy'])->name('deleterangespecialgroups');
        Route::get('/specialpricegroup/pelanggans/new',['middleware' => ['permission:manage-specialpricegroup'], 'uses' => 'SpecialpricegroupController@new_price_khusus_jenis_pelanggans'])->name('new_price_khusus_jenis_pelanggans');
        Route::post('/specialpricegroup/pelanggans',['middleware' => ['permission:manage-specialpricegroup'], 'uses' => 'SpecialpricegroupController@create_price_khusus_jenis_pelanggans'])->name('create_price_khusus_jenis_pelanggans');

        // Bahan Baku Route
        Route::get('/bahanbaku',['middleware' => ['permission:manage-bahanbaku'], 'uses' => 'BahanBakuController@index'])->name('managebahanbakuindex');
        Route::get('/bahanbaku/loadbahanbaku',['middleware' => ['permission:manage-bahanbaku'], 'uses' => 'BahanBakuController@loadbahanbaku'])->name('loadbahanbaku');
        Route::post('/bahanbaku/postbahanbaku',['middleware' => ['permission:add-bahanbaku'], 'uses' => 'BahanBakuController@store'])->name('storebahanbaku');
        Route::post('/bahanbaku/updatebahanbaku',['middleware' => ['permission:edit-bahanbaku'], 'uses' => 'BahanBakuController@update'])->name('updatebahanbaku');
        Route::post('/bahanbaku/deletebahanbaku',['middleware' => ['permission:delete-bahanbaku'], 'uses' => 'BahanBakuController@destroy'])->name('deletebahanbaku');

        // Relasi Bahan Baku Route
        Route::get('/relasibahanbaku',['middleware' => ['permission:manage-relasibahanbaku'], 'uses' => 'RelasiBahanBakuController@index'])->name('managerelasibahanbakuindex');
        Route::get('/relasibahanbaku/loadrelasibahanbaku',['middleware' => ['permission:manage-relasibahanbaku'], 'uses' => 'RelasiBahanBakuController@loadrelasibahanbaku'])->name('loadrelasibahanbaku');
        Route::post('/relasibahanbaku/postrelasibahanbaku',['middleware' => ['permission:add-relasibahanbaku'], 'uses' => 'RelasiBahanBakuController@store'])->name('storerelasibahanbaku');
        Route::post('/relasibahanbaku/updaterelasibahanbaku',['middleware' => ['permission:edit-relasibahanbaku'], 'uses' => 'RelasiBahanBakuController@update'])->name('updaterelasibahanbaku');
        Route::post('/relasibahanbaku/deleterelasibahanbaku',['middleware' => ['permission:delete-relasibahanbaku'], 'uses' => 'RelasiBahanBakuController@destroy'])->name('deleterelasibahanbaku');

                 

        //menu
        Route::get('/menu',['middleware' => ['permission:manage-menu'], 'uses' => 'KategoriMenuController@index'])->name('menuindex');
        Route::post('/menu',['middleware' => ['permission:manage-menu'], 'uses' => 'KategoriMenuController@index'])->name('menuindex');
        
        Route::get('/menu/add',['middleware' => ['permission:add-menu'], 'uses' => 'KategoriMenuController@create'])->name('addmenuindex');

        Route::post('/menu/add',['middleware' => ['permission:add-menu'], 'uses' => 'KategoriMenuController@store'])->name('storemenu');
        Route::get('/menu/edit/{id}',['middleware' => ['permission:edit-menu'], 'uses' => 'KategoriMenuController@show'])->name('showmenuindex');
        Route::put('/menu/edit/{id}',['middleware' => ['permission:edit-menu'], 'uses' => 'KategoriMenuController@update'])->name('updatemenu');
        Route::post('/menu/delete',['middleware' => ['permission:delete-menu'], 'uses' => 'KategoriMenuController@destroy'])->name('destroymenu');
        Route::get('/menu/data',['middleware' => ['permission:manage-menu'], 'uses' => 'KategoriMenuController@dataload'])->name('kategorimenudataload');

        //Laporan
        Route::get('/laporan',['middleware' => ['permission:view-laporan'], 'uses' => 'LaporanController@index'])->name('laporan');
        Route::get('/laporan/filter','LaporanController@filter')->name('filter');
        Route::get('/laporan/chart','LaporanController@linedatalaporan')->name('chartlaporan');

        // Menu Name Route
        Route::get('/menuname',['middleware' => ['permission:manage-menuname'], 'uses' => 'MenuNameController@index'])->name('managemenunameindex');
        Route::get('/menuname/loadmenuname',['middleware' => ['permission:manage-menuname'], 'uses' => 'MenuNameController@loadmenuname'])->name('loadmenuname');
        Route::post('/menuname/updatemenuname',['middleware' => ['permission:edit-menuname'], 'uses' => 'MenuNameController@update'])->name('updatemenuname');

        Route::get('/ubahpassword','UserController@indexchangepassword');
        Route::post('/ubahpassword','UserController@changepassword');
        Route::get('/logout','Auth\LoginController@logout');

        #data stok bahan baku
        Route::get('/stokbahanbaku',['middleware' => ['permission:list-stokbahanbaku'], 'uses' => 'StokBahanbakuController@index'])->name('indexstokbahanbaku');
        Route::post('/stokbahanbaku',['middleware' => ['permission:list-stokbahanbaku'], 'uses' => 'StokBahanbakuController@index'])->name('stokbahanbaku');
        Route::get('/stokbahanbaku/edit/{id}',['middleware' => ['permission:edit-stokbahanbaku'], 'uses' => 'StokBahanbakuController@edit'])->name('editstokbahanbaku');
        Route::put('/stokbahanbaku/edit/{id}',['middleware' => ['permission:edit-stokbahanbaku'], 'uses' => 'StokBahanbakuController@update'])->name('editstokbahanbaku');
        Route::post('/stokbahanbaku/delete',['middleware' => ['permission:delete-stokbahanbaku'], 'uses' => 'StokBahanbakuController@destroy'])->name('deletestokbahanbaku');
        Route::get('/bahanbaku/harga',['middleware' => ['permission:list-stokbahanbaku'], 'uses' => 'BahanBakuController@bahanbakuharga'])->name('bahanbakuharga');

        #transaksi bahan baku
        Route::get('/transaksi/bahan',['middleware' => ['permission:manage-transaksistokbahanbaku'], 'uses' => 'TransaksiBahanBakuController@index'])->name('indextransaksibahanbaku');
        Route::post('/transaksi/bahan',['middleware' => ['permission:manage-transaksistokbahanbaku'], 'uses' => 'TransaksiBahanBakuController@index'])->name('indextransaksibahanbakupost');
        Route::get('/transaksi/bahan/add',['middleware' => ['permission:add-transaksistokbahanbaku'], 'uses' => 'TransaksiBahanBakuController@create'])->name('createtransaksibahanbaku');
        Route::post('/transaksi/bahan/add',['middleware' => ['permission:add-transaksistokbahanbaku'], 'uses' => 'TransaksiBahanBakuController@store'])->name('storetransaksibahanbaku');
        Route::get('/transaksi/bahan/edit/{id}',['middleware' => ['permission:edit-transaksistokbahanbaku'], 'uses' => 'TransaksiBahanBakuController@show']);
        Route::put('/transaksi/bahan/edit/{id}',['middleware' => ['permission:edit-transaksistokbahanbaku'], 'uses' => 'TransaksiBahanBakuController@update']);
        Route::get('/transaksi/bahan/delete/{id}',['middleware' => ['permission:delete-transaksistokbahanbaku'], 'uses' => 'TransaksiBahanBakuController@destroy']);
        Route::get('/transaksi/bahan/deleted',['middleware' => ['permission:deleted-transaksistokbahanbaku'], 'uses' => 'TransaksiBahanBakuController@indexdeleted'])->name('indexdeletedtransaksibahanbaku');
        Route::post('/transaksi/bahan/deleted',['middleware' => ['permission:deleted-transaksistokbahanbaku'], 'uses' => 'TransaksiBahanBakuController@indexdeleted'])->name('indexdeletedtransaksibahanbakupost');




        Route::get('/timeline',['middleware' => ['permission:index-timeline'], 'uses' => 'ActivityLogController@index'])->name('timeline');


});
