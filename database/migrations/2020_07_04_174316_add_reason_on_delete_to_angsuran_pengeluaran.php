<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReasonOnDeleteToAngsuranPengeluaran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('Angsuran_Pengeluarans',function(Blueprint $table){
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
        Schema::table('Angsuran_Pengeluarans',function(Blueprint $table){
          $table->dropColumn('reason_on_delete');
        });
    }
}
