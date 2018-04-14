<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('Produks', function(Blueprint $table) {
			$table->foreign('kategori_id')->references('id')->on('Kategories')
						->onDelete('restrict')
						->onUpdate('cascade');
			
		});
		Schema::table('Produks', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('Users')
						->onDelete('restrict')
						->onUpdate('cascade');
		});
		Schema::table('Kategories', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('Users')
						->onDelete('restrict')
						->onUpdate('cascade');
		});
		Schema::table('Users', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('Users')
						->onDelete('restrict')
						->onUpdate('cascade');
		});
		Schema::table('Cabangs', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('Users')
						->onDelete('restrict')
						->onUpdate('cascade');
		});
		
		Schema::table('Pelanggans', function(Blueprint $table) {
			$table->foreign('jenispelanggan_id')->references('id')->on('Jenispelanggans')
						->onDelete('restrict')
						->onUpdate('cascade');
			$table->foreign('user_id')->references('id')->on('Users')
						->onDelete('restrict')
						->onUpdate('cascade');
		});
		Schema::table('Spesialprices', function(Blueprint $table) {
			$table->foreign('pelanggan_id')->references('id')->on('Pelanggans')
						->onDelete('restrict')
						->onUpdate('cascade');
		});
		Schema::table('Spesialprices', function(Blueprint $table) {
			$table->foreign('produk_id')->references('id')->on('Produks')
						->onDelete('restrict')
						->onUpdate('cascade');
		});
		Schema::table('Spesialprices', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('Users')
						->onDelete('restrict')
						->onUpdate('cascade');
		});
		Schema::table('Suppliers', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('Users')
						->onDelete('restrict')
						->onUpdate('cascade');
		});
		Schema::table('Transaksi_Penjualans', function(Blueprint $table) {
			$table->foreign('pelanggan_id')->references('id')->on('Pelanggans')
						->onDelete('restrict')
						->onUpdate('cascade');
		});
		Schema::table('Transaksi_Penjualans', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('Users')
						->onDelete('restrict')
						->onUpdate('cascade');
		});

		Schema::table('Sub_Tpenjualans', function(Blueprint $table) {
			$table->foreign('penjualan_id')->references('id')->on('Transaksi_Penjualans')
						->onDelete('restrict')
						->onUpdate('cascade');
		});
		Schema::table('Sub_Tpenjualans', function(Blueprint $table) {
			$table->foreign('produk_id')->references('id')->on('Produks')
						->onDelete('restrict')
						->onUpdate('cascade');
		});
		Schema::table('Sub_Tpenjualans', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('Users')
						->onDelete('restrict')
						->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::table('Produks', function(Blueprint $table) {
			$table->dropForeign('Produks_kategori_id_foreign');
		});
		Schema::table('Kategories', function(Blueprint $table) {
			$table->dropForeign('Kategories_user_id_foreign');
		});
		Schema::table('Cabangs', function(Blueprint $table) {
			$table->dropForeign('Cabangs_user_id_foreign');
		});
		
		Schema::table('Pelanggans', function(Blueprint $table) {
			$table->dropForeign('Pelanggans_jenispelanggan_id_foreign');
		});
		Schema::table('Spesialprices', function(Blueprint $table) {
			$table->dropForeign('Spesialprices_pelanggan_id_foreign');
		});
		Schema::table('Spesialprices', function(Blueprint $table) {
			$table->dropForeign('Spesialprices_produk_id_foreign');
		});
		Schema::table('Spesialprices', function(Blueprint $table) {
			$table->dropForeign('Spesialprices_user_id_foreign');
		});
		Schema::table('Suppliers', function(Blueprint $table) {
			$table->dropForeign('Suppliers_user_id_foreign');
		});
		Schema::table('Transaksi_Penjualans', function(Blueprint $table) {
			$table->dropForeign('Transaksi_Penjualans_pelanggan_id_foreign');
		});
		Schema::table('Sub_Tpenjualans', function(Blueprint $table) {
			$table->dropForeign('Sub_Tpenjualans_penjualan_id_foreign');
		});
		Schema::table('Sub_Tpenjualans', function(Blueprint $table) {
			$table->dropForeign('Sub_Tpenjualans_produk_id_foreign');
		});
		Schema::table('Sub_Tpenjualans', function(Blueprint $table) {
			$table->dropForeign('Sub_Tpenjualans_user_id_foreign');
		});
	}
}