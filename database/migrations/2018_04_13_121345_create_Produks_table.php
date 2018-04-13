<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProduksTable extends Migration {

	public function up()
	{
		Schema::create('Produks', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('kategori_id')->unsigned();
			$table->string('nama_produk', 128);
			$table->string('satuan', 20);
			$table->double('harga_beli');
			$table->double('harga_jual');
			$table->boolean('hitung_luas');
			$table->text('keterangan');
		});
	}

	public function down()
	{
		Schema::drop('Produks');
	}
}