<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAngsuranPengeluaransTable extends Migration {

	public function up()
	{
		Schema::create('Angsuran_Pengeluarans', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->date('tanggal_angsuran');
			$table->double('nominal_angsuran');
			$table->integer('user_id')->unsigned();
			$table->bigInteger('transaksipengeluaran_id')->unsigned();
			$table->integer('cabang_id')->unsigned();
			$table->string('metode_pembayaran', 10);
		});
	}

	public function down()
	{
		Schema::drop('Angsuran_Pengeluarans');
	}
}