<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdukbahanbakusTable extends Migration
{
    public function up()
	{
		Schema::create('Produkbahanbakus', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('produk_id')->unsigned();
			$table->integer('bahanbaku_id')->unsigned();
			$table->integer('qtypertrx');
		});
	}

	public function down()
	{
		Schema::drop('produkbahanbakus');
	}
}
