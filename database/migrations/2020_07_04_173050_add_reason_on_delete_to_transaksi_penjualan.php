<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReasonOnDeleteToTransaksiPenjualan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('Transaksi_Penjualans',function(Blueprint $table){
            $table->text('reason_on_delete')->nullable();
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
        Schema::table('Transaksi_Penjualans',function(Blueprint $table){
            $table->dropColumn('reason_on_delete');
        });
    }
}
