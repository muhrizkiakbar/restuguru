<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSpesialpricesTable extends Migration {

	public function up()
	{
		Schema::create('Spesialprices', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('pelanggan_id')->unsigned();
			$table->integer('produk_id')->unsigned();
			$table->double('harga_khusus');
			$table->integer('user_id')->unsigned()->nullable();
		});
	}

	public function down()
	{
		Schema::drop('Spesialprices');
	}
}