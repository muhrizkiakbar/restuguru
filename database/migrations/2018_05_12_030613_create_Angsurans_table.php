<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAngsuransTable extends Migration {

	public function up()
	{
		Schema::create('Angsurans', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->date('tanggal_angsuran');
			$table->double('nominal_angsuran');
			$table->integer('user_id')->unsigned();
			$table->bigInteger('transaksipenjualan_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('Angsurans');
	}
}