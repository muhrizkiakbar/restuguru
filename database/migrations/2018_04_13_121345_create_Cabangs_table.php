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
			$table->string('Kode_Cabang', 12)->nullable();
			$table->string('Nama_Cabang', 60)->nullable();
			$table->string('No_Telepon', 13)->nullable();
			$table->string('Email', 60)->nullable();
			$table->text('Alamat')->nullable();
			$table->string('Jenis_Cabang', 12)->nullable();
			$table->integer('user_id')->unsigned()->nullable();
		});
	}

	public function down()
	{
		Schema::drop('Cabangs');
	}
}