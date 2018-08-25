<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	public function up()
	{
		Schema::create('Users', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('nama', 128);
			$table->string('username', 20)->unique();
			$table->string('password', 255);
			$table->string('Telepon', 13);
			$table->double('gaji');
            $table->rememberToken();
			$table->text('Alamat');
			$table->integer('cabang_id')->unsigned()->nullable();
		});
	}

	public function down()
	{
		Schema::drop('Users');
	}
}