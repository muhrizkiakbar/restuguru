<?php

use Illuminate\Database\Seeder;
use App\Permission;
class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $permission = [
            [
        		'name' => 'index-home',
        		'display_name' => 'Halaman Utama',
						'description' => 'Halaman Utama',
						'index'=>'1',
						'urlindex'=>'homeindex'
            ],
        	[
        		'name' => 'manage-users',
        		'display_name' => 'Manajemen User/Karyawan',
        		'description' => 'Memanajemen user atau karyawan',
						'index'=>'1',
						'urlindex'=>'userindex'
            ],
            [
        		'name' => 'add-users',
        		'display_name' => 'Tambah User/Karyawan',
        		'description' => 'Menambah User atau karyawan',
						'index'=>'0'
            ],
            [
        		'name' => 'edit-users',
        		'display_name' => 'Edit User/Karyawan',
        		'description' => 'Mengubah User atau Karyawan',
						'index'=>'0'
            ],
            [
        		'name' => 'delete-users',
        		'display_name' => 'Hapus User/Karyawan',
        		'description' => 'Hapus User/Karyawan',
						'index'=>'0'
            ],
            [
        		'name' => 'manage-roles',
        		'display_name' => 'Manajemen Hak Akses User',
        		'description' => 'Mengatur Hak Akses User',
						'index'=>'1',
						'urlindex'=>'roleindex'
            ],
            [
        		'name' => 'add-roles',
        		'display_name' => 'Menambah Hak Akses User',
        		'description' => 'Menambah Hak Akses User',
						'index'=>'0'
            ],
            [
        		'name' => 'edit-roles',
        		'display_name' => 'Mengedit Role Listing',
        		'description' => 'Mengedit Hak Akses User',
						'index'=>'0',
            ],
            [
        		'name' => 'delete-roles',
        		'display_name' => 'Menghapus Role Listing',
        		'description' => 'Menghapus Hak Akses User',
						'index'=>'0'
            ],
            [
        		'name' => 'add-transaksipenjualan',
        		'display_name' => 'Tambah Transaksi Penjualan',
        		'description' => 'Melakukan Transaksi Penjualan',
						'index'=>'1',
						'urlindex'=>'addtransaksiindex'
            ],
            [
        		'name' => 'edit-transaksipenjualan',
        		'display_name' => 'Edit Transaksi Penjualan',
        		'description' => 'Mengedit Transaksi Penjualan',
						'index'=>'0'
            ],
            [
        		'name' => 'delete-transaksipenjualan',
        		'display_name' => 'Menghapus Transaksi Penjualan',
        		'description' => 'Menghapus Transaksi Penjualan',
						'index'=>'0'
            ],
            [
        		'name' => 'manage-transaksipenjualan',
        		'display_name' => 'Manajemen Transaksi Penjualan',
        		'description' => 'Mengelola Transaksi Penjualan',
						'index'=>'1',
						'urlindex'=>'transaksipenjualanmanageindex'
            ],
            [
        		'name' => 'deleted-transaksipenjualan',
        		'display_name' => 'Transaksi Penjualan Terhapus',
        		'description' => 'Melihat Terhapus Transaksi Penjualan',
						'index'=>'1',
						'urlindex'=>'transaksipenjualandeletedindex'
            ],
            [
        		'name' => 'manage-angsuranpenjualan',
        		'display_name' => 'Manajemen Angsuran Penjualan',
        		'description' => 'Manajemen Angsuran Penjualan',
						'index'=>'1',
						'urlindex'=>'angsuranpenjualanindex'
						],
						[
							'name' => 'list-angsuranpenjualan',
							'display_name' => 'Data Angsuran Penjualan',
							'description' => 'Data Angsuran Penjualan',
							'index'=>'1',
							'urlindex'=>'listangsuranpenjualanindex'
							],
            [
        		'name' => 'add-angsuranpenjualan',
        		'display_name' => 'Tambah Angsuran Penjualan',
        		'description' => 'Menambah Angsuran Penjualan',
						'index'=>'0'
            ],
            [
        		'name' => 'delete-angsuranpenjualan',
        		'display_name' => 'Hapus Angsuran Penjualan',
        		'description' => 'Menghapus Angsuran Penjualan',
						'index'=>'0'
            ],
            [
        		'name' => 'report-angsuranpenjualan',
        		'display_name' => 'Laporan Angsuran Penjualan',
        		'description' => 'Laporan Angsuran Penjualan',
						'index'=>'0'
            ],
            [
        		'name' => 'deleted-angsuranpenjualan',
        		'display_name' => 'Angsuran Penjualan Terhapus',
        		'description' => 'Melihat Terhapus Angsuran Penjualan',
						'index'=>'1',
						'urlindex'=>'angsuranpenjualandeletedindex'
            ],
            [
        		'name' => 'manage-transaksipengeluaran',
        		'display_name' => 'Manajemen Transaksi Pengeluaran',
        		'description' => 'Manajemen Transaksi Pengeluaran',
						'index'=>'1',
						'urlindex'=>'managetransaksipengeluaranindex'
            ],
            [
        		'name' => 'add-transaksipengeluaran',
        		'display_name' => 'Tambah Transaksi Pengeluaran',
        		'description' => 'Menambah Transaksi Pengeluaran',
						'index'=>'1',
						'urlindex'=>'addtransaksipengeluaranindex'
            ],
            [
        		'name' => 'edit-transaksipengeluaran',
        		'display_name' => 'Edit Transaksi Pengeluaran',
        		'description' => 'Mengubah Transaksi Pengeluaran',
						'index'=>'0'
            ],
            
        	[
        		'name' => 'delete-transaksipengeluaran',
        		'display_name' => 'Hapus Transaksi Pengeluaran',
        		'description' => 'Menghapus Transaksi Pengeluaran',
						'index'=>'0'
					],
					[
        		'name' => 'deleted-transaksipengeluaran',
        		'display_name' => 'Transaksi Pengeluaran Terhapus',
        		'description' => 'Melihat Terhapus Transaksi Pengeluaran',
						'index'=>'1',
						'urlindex'=>'pengeluarandeletedindex'
        	],
        	[
        		'name' => 'report-transaksipengeluaran',
        		'display_name' => 'Laporan Transaksi Pengeluaran',
        		'description' => 'Laporan Transaksi Pengeluaran',
						'index'=>'0'
        	],
        	[
        		'name' => 'manage-angsuranpengeluaran',
        		'display_name' => 'Manajemen Angsuran Pengeluaran',
        		'description' => 'Manajemen Angsuran Pengeluaran',
						'index'=>'1',
						'urlindex'=>'manageangsuranpengeluaranindex'
					],
					[
        		'name' => 'report-angsuranpengeluaran',
        		'display_name' => 'Laporan Angsuran Pengeluaran',
        		'description' => 'Laporan Angsuran Pengeluaran',
						'index'=>'0'
					],
					[
        		'name' => 'report-angsuranpengeluarandetail',
        		'display_name' => 'Laporan Det. Angsuran Pengeluaran',
        		'description' => 'Laporan Det. Angsuran Pengeluaran',
						'index'=>'0'
        	],
					[
        		'name' => 'list-angsuranpengeluaran',
        		'display_name' => 'Data Angsuran Pengeluaran',
        		'description' => 'Data Angsuran Pengeluaran',
						'index'=>'1',
						'urlindex'=>'listangsuranpengeluaranindex'
					],
					[
        		'name' => 'deleted-angsuranpengeluaran',
        		'display_name' => 'Angsuran Pengeluaran Terhapus',
        		'description' => 'Data Angsuran Pengeluaran Terhapus',
						'index'=>'1',
						'urlindex'=>'deletedangsuranpengeluaranindex'
        	],
        	[
        		'name' => 'add-angsuranpengeluaran',
        		'display_name' => 'Tambah Angsuran Pengeluaran',
        		'description' => 'Menambah Angsuran Pengeluaran',
						'index'=>'0'
            ],
            [
        		'name' => 'delete-angsuranpengeluaran',
        		'display_name' => 'Hapus Angsuran Pengeluaran',
        		'description' => 'Menghapus Angsuran Pengeluaran',
						'index'=>'0'
            ],
            [
        		'name' => 'manage-cabang',
        		'display_name' => 'Manajemen Cabang',
        		'description' => 'Manajemen Cabang',
						'index'=>'1',
						'urlindex'=>'managecabangindex'
            ],
            [
        		'name' => 'add-cabang',
        		'display_name' => 'Tambah Cabang',
        		'description' => 'Menambah Cabang',
						'index'=>'0'
            ],
            [
        		'name' => 'edit-cabang',
        		'display_name' => 'Edit Cabang',
        		'description' => 'Mengedit Cabang',
						'index'=>'0'
            ],
            [
        		'name' => 'delete-cabang',
        		'display_name' => 'Hapus Cabang',
        		'description' => 'Menghapus Cabang',
						'index'=>'0'
            ],
        	[
        		'name' => 'manage-pelanggan',
        		'display_name' => 'Manajemen Pelanggan',
        		'description' => 'Manajemen Pelanggan',
						'index'=>'1',
						'urlindex'=>'managepelangganindex'
            ],
            [
        		'name' => 'add-pelanggan',
        		'display_name' => 'Tambah Pelanggan',
        		'description' => 'Menambah Pelanggan',
						'index'=>'0'
            ],
            [
        		'name' => 'edit-pelanggan',
        		'display_name' => 'Edit Pelanggan',
        		'description' => 'Mengubah Pelanggan',
						'index'=>'0'
            ],
            [
        		'name' => 'delete-pelanggan',
        		'display_name' => 'Hapus Pelanggan',
        		'description' => 'Menghapus Pelanggan',
						'index'=>'0'
            ],
            [
        		'name' => 'manage-supplier',
        		'display_name' => 'Manajemen Supplier',
        		'description' => 'Manajemen Supplier',
						'index'=>'1',
						'urlindex'=>'managesupplierindex'
            ],
            [
        		'name' => 'add-supplier',
        		'display_name' => 'Tambah Supplier',
        		'description' => 'Menambah Supplier',
						'index'=>'0'
            ],
            [
        		'name' => 'edit-supplier',
        		'display_name' => 'Edit Supplier',
        		'description' => 'Mengubah Supplier',
						'index'=>'0'
        	],
        	[
        		'name' => 'delete-supplier',
        		'display_name' => 'Hapus Supplier',
        		'description' => 'Menghapus Supplier',
						'index'=>'0'
					],
					[
        		'name' => 'manage-produk',
        		'display_name' => 'Manajemen Produk',
        		'description' => 'Manajemen Produk',
						'index'=>'1',
						'urlindex'=>'manageprodukindex'
					],
					[
        		'name' => 'add-produk',
        		'display_name' => 'Tambah Produk',
        		'description' => 'Menambah Produk',
						'index'=>'0'
					],
					[
        		'name' => 'edit-produk',
        		'display_name' => 'Edit Produk',
        		'description' => 'Mengedit Produk',
						'index'=>'0'
					],
					[
        		'name' => 'delete-produk',
        		'display_name' => 'Hapus Produk',
        		'description' => 'Menghapus Produk',
						'index'=>'0'
					],
					[
        		'name' => 'manage-kategori',
        		'display_name' => 'Manajemen Kategori',
        		'description' => 'Manajemen Kategori',
						'index'=>'1',
						'urlindex'=>'managekategoriindex'
					],
					[
        		'name' => 'add-kategori',
        		'display_name' => 'Tambah Kategori',
        		'description' => 'Menambah Kategori',
						'index'=>'0'
					],
					[
        		'name' => 'edit-kategori',
        		'display_name' => 'Edit Kategori',
        		'description' => 'Mengedit Kategori',
						'index'=>'0'
					],
					[
        		'name' => 'delete-kategori',
        		'display_name' => 'Hapus Kategori',
        		'description' => 'Menghapus Kategori',
						'index'=>'0'
					],
        ];


        foreach ($permission as $key => $value) {
        	Permission::create($value);
        }
    }
}
