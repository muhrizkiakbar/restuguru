<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTransaksiPengeluaransTable extends Migration {

	public function up()
	{
		Schema::create('Transaksi_Pengeluarans', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('jenispengeluaran_id')->unsigned();
			$table->string('namapenerima', 250);
			$table->string('hppenerima', 13)->nullable();
			$table->double('total_pengeluaran');
			$table->double('pembayaran_pengeluaran');
			$table->double('sisa_pengeluaran');
			$table->integer('user_id')->unsigned();
			$table->integer('cabang_id')->unsigned();
			$table->integer('supplier_id')->unsigned()->nullable();
			$table->integer('clientuser_id')->unsigned()->nullable();
			$table->date('tanggal_pengeluaran');
			$table->string('metode_pembayaran', 30);
		});
	}

	public function down()
	{
		Schema::drop('Transaksi_Pengeluarans');
	}
}