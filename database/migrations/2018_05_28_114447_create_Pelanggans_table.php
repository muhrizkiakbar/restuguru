<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePelanggansTable extends Migration {

	public function up()
	{
		Schema::create('Pelanggans', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('jenispelanggan_id')->unsigned();
			$table->string('nama_perusahaan', 128);
			$table->string('nama_pemilik', 128);
			$table->string('telpon_pelanggan', 13);
			$table->string('hp_pelanggan', 13);
			$table->string('email_pelanggan', 128);
			$table->text('alamat_pelanggan');
			$table->integer('tempo_pelanggan');
			$table->double('limit_pelanggan');
			$table->string('norek_pelanggan', 50);
			$table->text('keterangan_pelanggan')->nullable();
			$table->text('ktp');
			$table->boolean('status_pelanggan');
		});
	}

	public function down()
	{
		Schema::drop('Pelanggans');
	}
}