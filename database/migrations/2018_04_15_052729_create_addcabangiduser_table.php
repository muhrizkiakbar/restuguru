<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddcabangiduserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {    
            $table->integer('cabang_id')->unsigned()->nullable();
        });

        Schema::table('users', function(Blueprint $table) {
			$table->foreign('cabang_id')->references('id')->on('Cabangs')
						->onDelete('restrict')
						->onUpdate('cascade');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addcabangiduser');
    }
}
