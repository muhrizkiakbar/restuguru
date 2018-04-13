<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateKategoriesTable extends Migration {

	public function up()
	{
		Schema::create('Kategories', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('Nama_Kategori', 128);
			$table->longText('Keterangan');
			$table->integer('user_id')->unsigned()->nullable();
		});
	}

	public function down()
	{
		Schema::drop('Kategories');
	}
}