<?php


use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRangePriceGroup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('RangePriceGroups', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('special_price_group_id')->unsigned();
          $table->integer('nilai_awal');
          $table->integer('nilai_akhir');
          $table->double('harga_khusus');
          $table->integer('user_id')->unsigned();
          $table->timestamps();
          $table->softDeletes();
        });

        Schema::table('RangePriceGroups', function(Blueprint $table) {
            $table->foreign('special_price_group_id')->references('id')->on('Spesialpricesgroups')
                        ->onDelete('cascade')
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
      Schema::drop('RangePriceGroups');
    }
}
