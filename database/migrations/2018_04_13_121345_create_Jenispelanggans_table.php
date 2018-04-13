<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateJenispelanggansTable extends Migration {

	public function up()
	{
		Schema::create('Jenispelanggans', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('jenis_pelanggan', 60);
		});
	}

	public function down()
	{
		Schema::drop('Jenispelanggans');
	}
}