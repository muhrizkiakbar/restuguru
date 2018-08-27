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
							'name' => 'report-angsuranpenjualandetail',
							'display_name' => 'Laporan Angsuran Penjualan Detail',
							'description' => 'Laporan Angsuran Penjualan Detail',
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
                'name' => 'manage-jenispengeluaran',
                'display_name' => 'Manaj. Jenis Pengeluaran',
                'description' => 'Manajemen Jenis Pengeluaran',
                'index' => '1',
                'urlindex' => 'jenispengeluaranindex'
            ],
            [
                'name' => 'store-jenispengeluaran',
                'display_name' => 'Tambah Jenis Pengeluaran',
                'description' => 'Menambah Jenis Pengeluaran',
                'index' => '0'
            ],
            [
                'name' => 'edit-jenispengeluaran',
                'display_name' => 'Edit Jenis Pengeluaran',
                'description' => 'Mengedit Jenis Pengeluaran',
                'index' => '0'
            ],
            [
                'name' => 'destroy-jenispengeluaran',
                'display_name' => 'Hapus Jenis Pengeluaran',
                'description' => 'Menghapus Jenis Pengeluaran',
                'index' => '0'
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
						'name' => 'manage-jenispelanggan',
						'display_name' => 'Manajemen Jenis Pelanggan',
						'description' => 'Manajemen Jenis Pelanggan',
						'index'=>'1',
						'urlindex'=>'managejenispelangganindex'
						],
						[
						'name' => 'add-jenispelanggan',
						'display_name' => 'Tambah Jenis Pelanggan',
						'description' => 'Menambah Jenis Pelanggan',
						'index'=>'0'
						],
						[
						'name' => 'edit-jenispelanggan',
						'display_name' => 'Edit Jenis Pelanggan',
						'description' => 'Mengubah Jenis Pelanggan',
						'index'=>'0'
						],
						[
							'name' => 'delete-jenispelanggan',
							'display_name' => 'Hapus Jenis Pelanggan',
							'description' => 'Menghapus Jenis Pelanggan',
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
					[
        		'name' => 'manage-specialprice',
        		'display_name' => 'Manajemen Harga Khusus',
        		'description' => 'Manajemen Harga Khusus',
						'index'=>'1',
						'urlindex'=>'managespecialprice'
					],
					[
        		'name' => 'add-specialprice',
        		'display_name' => 'Tambah Harga Khusus',
        		'description' => 'Menambah Harga Khusus',
						'index'=>'0'
					],
					[
        		'name' => 'edit-specialprice',
        		'display_name' => 'Edit Harga Khusus',
        		'description' => 'Mengedit Harga Khusus',
						'index'=>'0'
					],
					[
        		'name' => 'delete-specialprice',
        		'display_name' => 'Hapus Harga Khusus',
        		'description' => 'Menghapus Harga Khusus',
						'index'=>'0'
					],
					[
        		'name' => 'manage-specialpricegroup',
        		'display_name' => 'Manaj. Harga Khusus Group',
        		'description' => 'Manajemen Harga Khusus',
						'index'=>'1',
						'urlindex'=>'managespecialpricegroup'
					],
					[
        		'name' => 'add-specialpricegroup',
        		'display_name' => 'Tambah Harga Khusus Group',
        		'description' => 'Menambah Harga Khusus',
						'index'=>'0'
					],
					[
        		'name' => 'edit-specialpricegroup',
        		'display_name' => 'Edit Harga Khusus Group',
        		'description' => 'Mengedit Harga Khusus',
						'index'=>'0'
					],
					[
        		'name' => 'delete-specialpricegroup',
        		'display_name' => 'Hapus Harga Khusus Group',
        		'description' => 'Menghapus Harga Khusus',
						'index'=>'0'
					],
				[
					'name' => 'manage-menu',
					'display_name' => 'Manajemen Menu',
					'description' => 'Manajemen Menu',
					'index'=>'1',
					'urlindex'=>'menuindex'
				],
				[
					'name' => 'add-menu',
					'display_name' => 'Tambah Menu',
					'description' => 'Menambah Menu',
					'index'=>'1',
					'urlindex'=>'addmenuindex'
				],
				[
					'name' => 'edit-menu',
					'display_name' => 'Edit Menu',
					'description' => 'Mengedit Menu',
					'index'=>'0'
				],
				[
					'name' => 'delete-menu',
					'display_name' => 'Hapus Menu',
					'description' => 'Menghapus Menu',
					'index'=>'0'
				],
				[
					'name' => 'manage-bahanbaku',
					'display_name' => 'Manajemen Bahan Baku',
					'description' => 'Manajemen Bahan Baku',
					'index'=>'1',
					'urlindex'=> 'managebahanbakuindex'
				],
				[
					'name' => 'add-bahanbaku',
					'display_name' => 'Tambah Bahan Baku',
					'description' => 'Tambah Bahan Baku',
					'index'=>'0'
				],
				[
					'name' => 'edit-bahanbaku',
					'display_name' => 'Edit Bahan Baku',
					'description' => 'Edit Bahan Baku',
					'index'=>'0'
				],
				[
					'name' => 'delete-bahanbaku',
					'display_name' => 'Hapus Bahan Baku',
					'description' => 'Hapus Bahan Baku',
					'index'=>'0'
				],
				[
					'name' => 'manage-relasibahanbaku',
					'display_name' => 'Manajemen Aturan Bahan Baku',
					'description' => 'Manajemen Aturan Bahan Baku',
					'index'=>'1',
					'urlindex'=> 'managerelasibahanbakuindex'
				],
				[
					'name' => 'add-relasibahanbaku',
					'display_name' => 'Tambah Aturan Bahan Baku',
					'description' => 'Tambah Aturan Bahan Baku',
					'index'=>'0'
				],
				[
					'name' => 'edit-relasibahanbaku',
					'display_name' => 'Edit Aturan Bahan Baku',
					'description' => 'Edit Aturan Bahan Baku',
					'index'=>'0'
				],
				[
					'name' => 'delete-relasibahanbaku',
					'display_name' => 'Hapus Aturan Bahan Baku',
					'description' => 'Hapus Aturan Bahan Baku',
					'index'=>'0'
				],

				[
						'name' => 'manage-menuname',
						'display_name' => 'Manajemen Nama Menu',
						'description' => 'Manajemen Nama Menu',
						'index'=>'1',
						'urlindex'=>'managemenunameindex'
				],
				[
					'name' => 'edit-menuname',
					'display_name' => 'Edit Nama Menu',
					'description' => 'Mengedit Nama Menu',
					'index'=>'0'
				],
				[
					'name' => 'view-laporan',
					'display_name' => 'Laporan',
					'description' => 'Laporan',
					'index'=>'1',
					'urlindex'=>'laporan'
				],
				[
					'name' => 'index-timeline',
					'display_name' => 'Aktifitas Pengguna',
					'description' => 'Aktifitas Pengguna',
					'index'=>'1',
					'urlindex'=>'timeline'
				],
				[
					'name' => 'list-stokbahanbaku',
					'display_name' => 'Daftar Bahan Baku',
					'description' => 'Daftar Bahan Baku',
					'index'=>'1',
					'urlindex'=>'indexstokbahanbaku'
				],
				[
					'name' => 'manage-transaksistokbahanbaku',
					'display_name' => 'Manajemen Transaksi Bahan Baku',
					'description' => 'Manajemen Transaksi Bahan Baku',
					'index'=>'1',
					'urlindex'=>'indextransaksibahanbaku'
				],
				[
					'name' => 'add-transaksistokbahanbaku',
					'display_name' => 'Tambah Transaksi Bahan Baku',
					'description' => 'Tambah Transaksi Bahan Baku',
					'index'=>'0',
				],
				[
					'name' => 'edit-transaksistokbahanbaku',
					'display_name' => 'Ubah Transaksi Bahan Baku',
					'description' => 'Ubah Transaksi Bahan Baku',
					'index'=>'0',
				],
				[
					'name' => 'delete-transaksistokbahanbaku',
					'display_name' => 'Hapus Transaksi Bahan Baku',
					'description' => 'Hapus Transaksi Bahan Baku',
					'index'=>'0',
				],
				[
					'name' => 'deleted-transaksistokbahanbaku',
					'display_name' => 'Transaksi Bahan Baku Terhapus',
					'description' => 'Transaksi Bahan Baku Terhapus',
					'index'=>'1',
					'urlindex'=>'indexdeletedtransaksibahanbaku'
				],

        ];


        foreach ($permission as $key => $value) {
        	Permission::create($value);
        }
    }
}
