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
        		'description' => 'Halaman Utama'
            ],
        	[
        		'name' => 'manage-users',
        		'display_name' => 'Manajemen User/Karyawan',
        		'description' => 'Memanajemen user atau karyawan'
            ],
            [
        		'name' => 'add-users',
        		'display_name' => 'Tambah User/Karyawan',
        		'description' => 'Menambah User atau karyawan'
            ],
            [
        		'name' => 'edit-users',
        		'display_name' => 'Edit User/Karyawan',
        		'description' => 'Mengubah User atau Karyawan'
            ],
            [
        		'name' => 'delete-users',
        		'display_name' => 'Hapus User/Karyawan',
        		'description' => 'Hapus User/Karyawan'
            ],
            [
        		'name' => 'manage-roles',
        		'display_name' => 'Manajemen Hak Akses User',
        		'description' => 'Mengatur Hak Akses User'
            ],
            [
        		'name' => 'add-roles',
        		'display_name' => 'Menambah Hak Akses User',
        		'description' => 'Menambah Hak Akses User'
            ],
            [
        		'name' => 'edit-roles',
        		'display_name' => 'Mengedit Role Listing',
        		'description' => 'Mengedit Hak Akses User'
            ],
            [
        		'name' => 'delete-roles',
        		'display_name' => 'Menghapus Role Listing',
        		'description' => 'Menghapus Hak Akses User'
            ],
            [
        		'name' => 'add-transaksipenjualan',
        		'display_name' => 'Tambah Transaksi Penjualan',
        		'description' => 'Melakukan Transaksi Penjualan'
            ],
            [
        		'name' => 'edit-transaksipenjualan',
        		'display_name' => 'Edit Transaksi Penjualan',
        		'description' => 'Mengedit Transaksi Penjualan'
            ],
            [
        		'name' => 'delete-transaksipenjualan',
        		'display_name' => 'Menghapus Transaksi Penjualan',
        		'description' => 'Menghapus Transaksi Penjualan'
            ],
            [
        		'name' => 'manage-transaksipenjualan',
        		'display_name' => 'Manajemen Transaksi Penjualan',
        		'description' => 'Mengelola Transaksi Penjualan'
            ],
            [
        		'name' => 'deleted-transaksipenjualan',
        		'display_name' => 'Melihat Terhapus Transaksi Penjualan',
        		'description' => 'Melihat Terhapus Transaksi Penjualan'
            ],
            [
        		'name' => 'manage-angsuranpenjualan',
        		'display_name' => 'Manajemen Angsuran Penjualan',
        		'description' => 'Manajemen Angsuran Penjualan'
						],
						[
							'name' => 'list-angsuranpenjualan',
							'display_name' => 'Data Angsuran Penjualan',
							'description' => 'Data Angsuran Penjualan'
							],
            [
        		'name' => 'add-angsuranpenjualan',
        		'display_name' => 'Tambah Angsuran Penjualan',
        		'description' => 'Menambah Angsuran Penjualan'
            ],
            [
        		'name' => 'delete-angsuranpenjualan',
        		'display_name' => 'Hapus Angsuran Penjualan',
        		'description' => 'Menghapus Angsuran Penjualan'
            ],
            [
        		'name' => 'report-angsuranpenjualan',
        		'display_name' => 'Laporan Angsuran Penjualan',
        		'description' => 'Laporan Angsuran Penjualan'
            ],
            [
        		'name' => 'deleted-angsuranpenjualan',
        		'display_name' => 'Melihat Terhapus Angsuran Penjualan',
        		'description' => 'Melihat Terhapus Angsuran Penjualan'
            ],
            [
        		'name' => 'manage-transaksipengeluaran',
        		'display_name' => 'Manajemen Transaksi Pengeluaran',
        		'description' => 'Manajemen Transaksi Pengeluaran'
            ],
            [
        		'name' => 'add-transaksipengeluaran',
        		'display_name' => 'Tambah Transaksi Pengeluaran',
        		'description' => 'Menambah Transaksi Pengeluaran'
            ],
            [
        		'name' => 'edit-transaksipengeluaran',
        		'display_name' => 'Edit Transaksi Pengeluaran',
        		'description' => 'Mengubah Transaksi Pengeluaran'
            ],
            
        	[
        		'name' => 'delete-transaksipengeluaran',
        		'display_name' => 'Hapus Transaksi Pengeluaran',
        		'description' => 'Menghapus Transaksi Pengeluaran'
					],
					[
        		'name' => 'deleted-transaksipengeluaran',
        		'display_name' => 'History Terhapus Transaksi Pengeluaran',
        		'description' => 'History Terhapus Transaksi Pengeluaran'
        	],
        	[
        		'name' => 'report-transaksipengeluaran',
        		'display_name' => 'Laporan Transaksi Pengeluaran',
        		'description' => 'Laporan Transaksi Pengeluaran'
        	],
        	[
        		'name' => 'manage-angsuranpengeluaran',
        		'display_name' => 'Manajemen Angsuran Pengeluaran',
        		'description' => 'Manajemen Angsuran Pengeluaran'
					],
					[
        		'name' => 'list-angsuranpengeluaran',
        		'display_name' => 'Data Angsuran Pengeluaran',
        		'description' => 'Data Angsuran Pengeluaran'
        	],
        	[
        		'name' => 'add-angsuranpengeluaran',
        		'display_name' => 'Tambah Angsuran Pengeluaran',
        		'description' => 'Menambah Angsuran Pengeluaran'
            ],
            [
        		'name' => 'delete-angsuranpengeluaran',
        		'display_name' => 'Hapus Angsuran Pengeluaran',
        		'description' => 'Menghapus Angsuran Pengeluaran'
            ],
            [
        		'name' => 'manage-cabang',
        		'display_name' => 'Manajemen Cabang',
        		'description' => 'Manajemen Cabang'
            ],
            [
        		'name' => 'add-cabang',
        		'display_name' => 'Tambah Cabang',
        		'description' => 'Menambah Cabang'
            ],
            [
        		'name' => 'edit-cabang',
        		'display_name' => 'Edit Cabang',
        		'description' => 'Mengedit Cabang'
            ],
            [
        		'name' => 'delete-cabang',
        		'display_name' => 'Hapus Cabang',
        		'description' => 'Menghapus Cabang'
            ],
        	[
        		'name' => 'manage-pelanggan',
        		'display_name' => 'Manajemen Pelanggan',
        		'description' => 'Manajemen Pelanggan'
            ],
            [
        		'name' => 'add-pelanggan',
        		'display_name' => 'Tambah Pelanggan',
        		'description' => 'Menambah Pelanggan'
            ],
            [
        		'name' => 'edit-pelanggan',
        		'display_name' => 'Edit Pelanggan',
        		'description' => 'Mengubah Pelanggan'
            ],
            [
        		'name' => 'delete-pelanggan',
        		'display_name' => 'Hapus Pelanggan',
        		'description' => 'Menghapus Pelanggan'
            ],
            [
        		'name' => 'manage-supplier',
        		'display_name' => 'Manajemen Supplier',
        		'description' => 'Manajemen Supplier'
            ],
            [
        		'name' => 'add-supplier',
        		'display_name' => 'Tambah Supplier',
        		'description' => 'Menambah Supplier'
            ],
            [
        		'name' => 'edit-supplier',
        		'display_name' => 'Edit Supplier',
        		'description' => 'Mengubah Supplier'
        	],
        	[
        		'name' => 'delete-supplier',
        		'display_name' => 'Hapus Supplier',
        		'description' => 'Menghapus Supplier'
					],
					[
        		'name' => 'manage-produk',
        		'display_name' => 'Manajemen Produk',
        		'description' => 'Manajemen Produk'
					],
					[
        		'name' => 'add-produk',
        		'display_name' => 'Tambah Produk',
        		'description' => 'Menambah Produk'
					],
					[
        		'name' => 'edit-produk',
        		'display_name' => 'Edit Produk',
        		'description' => 'Mengedit Produk'
					],
					[
        		'name' => 'delete-produk',
        		'display_name' => 'Hapus Produk',
        		'description' => 'Menghapus Produk'
					],
					[
        		'name' => 'manage-kategori',
        		'display_name' => 'Manajemen Kategori',
        		'description' => 'Manajemen Kategori'
					],
					[
        		'name' => 'add-kategori',
        		'display_name' => 'Tambah Kategori',
        		'description' => 'Menambah Kategori'
					],
					[
        		'name' => 'edit-kategori',
        		'display_name' => 'Edit Kategori',
        		'description' => 'Mengedit Kategori'
					],
					[
        		'name' => 'delete-kategori',
        		'display_name' => 'Hapus Kategori',
        		'description' => 'Menghapus Kategori'
					],
        ];


        foreach ($permission as $key => $value) {
        	Permission::create($value);
        }
    }
}
