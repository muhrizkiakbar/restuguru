<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStokbahanbakusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stokbahanbakus', function (Blueprint $table) {
            $table->increments('id');
            $table->float('banyakstok');
            $table->string('satuan');
            $table->boolean('stokhitungluas');
            $table->integer('bahanbaku_id')->unsigned();
			$table->integer('cabang_id')->unsigned();            
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('stokbahanbakus', function(Blueprint $table) {

            $table->foreign('bahanbaku_id')->references('id')->on('Bahanbakus')
                        ->onDelete('restrict')
                        ->onUpdate('cascade');
                        
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
        Schema::dropIfExists('stokbahanbakus');
    }
}
