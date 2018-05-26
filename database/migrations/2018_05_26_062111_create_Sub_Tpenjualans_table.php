<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSubTpenjualansTable extends Migration {

	public function up()
	{
		Schema::create('Sub_Tpenjualans', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->timestamps();
			$table->softDeletes();
			$table->bigInteger('penjualan_id')->unsigned();
			$table->integer('produk_id')->unsigned();
			$table->double('harga_satuan');
			$table->double('panjang');
			$table->double('lebar');
			$table->integer('banyak');
			$table->longText('keterangan')->nullable();
			$table->integer('user_id')->unsigned();
			$table->double('subtotal');
			$table->double('diskon');
			$table->string('finishing', 100);
			$table->string('satuan', 10)->nullable();
		});
	}

	public function down()
	{
		Schema::drop('Sub_Tpenjualans');
	}
}