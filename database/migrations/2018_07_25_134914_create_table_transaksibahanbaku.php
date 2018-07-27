<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTransaksibahanbaku extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('transaksibahanbakus', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->date('tanggal');
			$table->integer('bahanbaku_id')->unsigned();
			$table->integer('cabangdari_id')->unsigned();
			$table->integer('cabangtujuan_id')->unsigned();
			$table->double('banyak');
			$table->string('satuan', 20);
			$table->text('keterangan')->nullable();
			$table->integer('user_id')->unsigned();
		});

        Schema::table('transaksibahanbakus', function(Blueprint $table) {

			$table->foreign('user_id')->references('id')->on('Users')
						->onDelete('restrict')
                        ->onUpdate('cascade');

            $table->foreign('bahanbaku_id')->references('id')->on('Bahanbakus')
                        ->onDelete('restrict')
                        ->onUpdate('cascade');
                        
            $table->foreign('cabangdari_id')->references('id')->on('Cabangs')
						->onDelete('restrict')
                        ->onUpdate('cascade');
                        
            $table->foreign('cabangtujuan_id')->references('id')->on('Cabangs')
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
        //
        Schema::drop('transaksibahanbakus');

        Schema::table('transaksibahanbakus', function(Blueprint $table) {
			$table->dropForeign('transaksibahanbakus_user_id_foreign');
			$table->dropForeign('transaksibahanbakus_cabangdari_id_foreign');
			$table->dropForeign('transaksibahanbakus_cabangtujuan_id_foreign');
		});
    }
}
