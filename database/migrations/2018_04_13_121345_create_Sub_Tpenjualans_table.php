<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSubTpenjualansTable extends Migration {

	public function up()
	{
		Schema::create('Sub_Tpenjualans', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('penjualan_id')->unsigned();
			$table->integer('produk_id')->unsigned();
			$table->double('harga_satuan');
			$table->double('panjang');
			$table->double('lebar');
			$table->integer('banyak');
			$table->longText('keterangan');
			$table->integer('user_id')->unsigned();
			$table->double('total_harga');
			$table->double('diskon');
		});
	}

	public function down()
	{
		Schema::drop('Sub_Tpenjualans');
	}
}