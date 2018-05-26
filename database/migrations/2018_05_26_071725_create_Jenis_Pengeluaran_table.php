<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateJenisPengeluaranTable extends Migration {

	public function up()
	{
		Schema::create('Jenis_Pengeluaran', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('jenis_pengeluaran', 125);
			$table->mediumText('keterangan')->nullable();
			$table->boolean('sifat_angsuran');
		});
	}

	public function down()
	{
		Schema::drop('Jenis_Pengeluaran');
	}
}