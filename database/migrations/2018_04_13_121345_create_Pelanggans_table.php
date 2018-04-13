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
			$table->integer('jenispelanggan_id')->unsigned()->nullable();
			$table->string('nama_perusahaan', 128)->nullable();
			$table->string('nama_pemilik', 128)->nullable();
			$table->string('telpon_pelanggan', 13)->nullable();
			$table->string('hp_pelanggan', 13)->nullable();
			$table->string('email_pelanggan', 128)->nullable();
			$table->text('alamat_pelanggan')->nullable();
			$table->integer('tempo_pelanggan')->nullable();
			$table->double('limit_pelanggan')->nullable();
			$table->string('norek_pelanggan', 50)->nullable();
			$table->text('keterangan_pelanggan')->nullable();
			$table->text('ktp')->nullable();
			$table->boolean('status_pelanggan')->nullable();
			$table->integer('user_id')->unsigned()->nullable();
		});
	}

	public function down()
	{
		Schema::drop('Pelanggans');
	}
}