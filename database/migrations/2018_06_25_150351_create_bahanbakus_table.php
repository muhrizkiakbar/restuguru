<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBahanbakusTable extends Migration{
    public function up()
	{
		Schema::create('Bahanbakus', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('kategori_id')->unsigned();
			$table->string('nama_bahan', 200);
			$table->string('satuan', 20);
			$table->double('harga');
			$table->integer('batas_stok');
			$table->tinyInteger('hitung_luas');
			$table->text('keterangan');
		});

<<<<<<< HEAD:database/migrations/2018_05_27_150351_create_bahanbakus_table.php
		Schema::table('Bahanbakus', function(Blueprint $table) {
=======
        Schema::table('Bahanbakus', function(Blueprint $table) {
>>>>>>> master:database/migrations/2018_06_25_150351_create_bahanbakus_table.php
			$table->foreign('kategori_id')->references('id')->on('Kategories')
						->onDelete('restrict')
						->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::drop('Bahanbakus');
<<<<<<< HEAD:database/migrations/2018_05_27_150351_create_bahanbakus_table.php
		
		Schema::table('Bahanbakus', function(Blueprint $table) {
=======

        Schema::table('Bahanbakus', function(Blueprint $table) {
>>>>>>> master:database/migrations/2018_06_25_150351_create_bahanbakus_table.php
			$table->dropForeign('Bahanbakus_kategori_id_foreign');
		});
	}
}
