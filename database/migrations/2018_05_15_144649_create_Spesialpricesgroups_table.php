<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSpesialpricesgroupsTable extends Migration {

	public function up()
	{
		Schema::create('Spesialpricesgroups', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('jenispelanggan_id')->unsigned();
			$table->integer('produk_id')->unsigned();
			$table->double('harga_khusus');
			$table->integer('user_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('Spesialpricesgroups');
	}
}