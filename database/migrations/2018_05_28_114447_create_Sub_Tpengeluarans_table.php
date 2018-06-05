<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSubTpengeluaransTable extends Migration {

	public function up()
	{
		Schema::create('Sub_Tpengeluarans', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('nama_bahanbaku', 200);
			$table->double('harga_satuan');
			$table->double('panjang')->nullable();
			$table->double('lebar')->nullable();
			$table->double('kuantitas');
			$table->longText('keterangan')->nullable();
			$table->double('sub_totalpengeluaran');
			$table->integer('user_id')->unsigned();
			$table->bigInteger('transaksipengeluaran_id')->unsigned();
			$table->integer('cabang_id')->unsigned();
			$table->string('satuan', 15)->nullable();
		});
	}

	public function down()
	{
		Schema::drop('Sub_Tpengeluarans');
	}
}