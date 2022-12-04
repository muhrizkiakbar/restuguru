<?php


use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRangePricePelanggan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('RangePricePelanggans', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('special_price_pelanggan_id')->unsigned();
          $table->integer('nilai_awal');
          $table->integer('nilai_akhir');
          $table->double('harga_khusus');
          $table->integer('user_id')->unsigned();
          $table->timestamps();
          $table->softDeletes();
        });

        Schema::table('RangePricePelanggans', function(Blueprint $table) {
            $table->foreign('special_price_pelanggan_id')->references('id')->on('Spesialprices')
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
      Schema::drop('RangePricePelanggans');
    }
}
