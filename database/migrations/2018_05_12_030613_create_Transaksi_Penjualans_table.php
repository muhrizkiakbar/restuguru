<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTransaksiPenjualansTable extends Migration {

	public function up()
	{
		Schema::create('Transaksi_Penjualans', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('nomor_nota', 128)->unique();
			$table->string('hp_pelanggan', 13);
			$table->string('nama_pelanggan', 60);
			$table->integer('pelanggan_id')->unsigned();
			$table->date('tanggal');
			$table->double('total_harga');
			$table->double('diskon');
			$table->string('metode_pembayaran');
			$table->double('jumlah_pembayaran');
			$table->double('sisa_tagihan');
		});
	}

	public function down()
	{
		Schema::drop('Transaksi_Penjualans');
	}
}