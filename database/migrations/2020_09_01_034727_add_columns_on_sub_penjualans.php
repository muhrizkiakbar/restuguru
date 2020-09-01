<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsOnSubPenjualans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

      Schema::table('Sub_Tpenjualans',function(Blueprint $table){
          $table->integer('useredited_id')->unsigned()->nullable();
          $table->integer('cabang_id')->unsigned()->nullable();
          $table->foreign('useredited_id')->references('id')->on('Users');
          $table->foreign('cabang_id')->references('id')->on('Cabangs');
          $table->text('reason_on_edit')->nullable();
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
