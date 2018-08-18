<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBahanbakuIdToStokbahanbakusColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('Sub_Tpengeluarans',function(Blueprint $table){
			$table->integer('bahanbaku_id')->unsigned()->nullable();            
        });

        Schema::table('Sub_Tpengeluarans', function(Blueprint $table) {

            $table->foreign('bahanbaku_id')->references('id')->on('Bahanbakus')
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
    }
}
