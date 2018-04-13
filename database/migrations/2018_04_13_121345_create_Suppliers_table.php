<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSuppliersTable extends Migration {

	public function up()
	{
		Schema::create('Suppliers', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('nama_supplier', 68);
			$table->string('pemilik_supplier', 68);
			$table->string('telpon_supplier', 13);
			$table->string('email_supplier', 160);
			$table->text('alamat_supplier');
			$table->string('rekening_suppliers', 30);
			$table->mediumText('keterangan_suppliers');
			$table->integer('user_id')->unsigned()->nullable();
		});
	}

	public function down()
	{
		Schema::drop('Suppliers');
	}
}