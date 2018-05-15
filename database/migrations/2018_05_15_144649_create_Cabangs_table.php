<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCabangsTable extends Migration {

	public function up()
	{
		Schema::create('Cabangs', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('Kode_Cabang', 12);
			$table->string('Nama_Cabang', 60);
			$table->string('No_Telepon', 13);
			$table->string('Email', 60);
			$table->text('Alamat');
			$table->string('Jenis_Cabang', 12);
			$table->integer('user_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('Cabangs');
	}
}