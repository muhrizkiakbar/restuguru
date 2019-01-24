<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeOnchangeOndelete extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 
        Schema::table('Kategories', function(Blueprint $table) {
        	$table->dropForeign('kategories_user_id_foreign');
            $table->dropIndex('kategories_user_id_foreign');
        
        });
        Schema::table('Cabangs', function(Blueprint $table) {
            $table->dropForeign('cabangs_user_id_foreign');            
            $table->dropIndex('cabangs_user_id_foreign');
		});
        Schema::table('Spesialprices', function(Blueprint $table) {
            $table->dropForeign('spesialprices_user_id_foreign');
            $table->dropIndex('spesialprices_user_id_foreign');
            
        });


        Schema::table('Suppliers', function(Blueprint $table) {
            $table->dropForeign('suppliers_user_id_foreign');

            $table->dropIndex('suppliers_user_id_foreign');
            
        });

        Schema::table('Transaksi_Penjualans', function(Blueprint $table) {
            $table->dropForeign('transaksi_penjualans_user_id_foreign');
            $table->dropIndex('transaksi_penjualans_user_id_foreign');
            
        });
        Schema::table('Sub_Tpenjualans', function(Blueprint $table) {
            $table->dropForeign('sub_tpenjualans_user_id_foreign');
            $table->dropIndex('sub_tpenjualans_user_id_foreign');
            
        });
        Schema::table('Spesialpricesgroups', function(Blueprint $table) {
            $table->dropForeign('spesialpricesgroups_user_id_foreign');
            $table->dropIndex('spesialpricesgroups_user_id_foreign');
            
        });
        Schema::table('Angsurans', function(Blueprint $table) {
            $table->dropForeign('angsurans_user_id_foreign');
            $table->dropIndex('angsurans_user_id_foreign');
            
        });
        Schema::table('Transaksi_Pengeluarans', function(Blueprint $table) {
            $table->dropForeign('transaksi_pengeluarans_user_id_foreign');
            $table->dropIndex('transaksi_pengeluarans_user_id_foreign');
            
        });
        Schema::table('Sub_Tpengeluarans', function(Blueprint $table) {
            $table->dropForeign('sub_tpengeluarans_user_id_foreign');
            $table->dropIndex('sub_tpengeluarans_user_id_foreign');
            
        });
        Schema::table('Angsuran_Pengeluarans', function(Blueprint $table) {
            $table->dropForeign('angsuran_pengeluarans_user_id_foreign');
            $table->dropIndex('angsuran_pengeluarans_user_id_foreign');
            
        });
        


        Schema::table('Kategories', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('Users')
						->onDelete('no action')
						->onUpdate('no action');
        });
        Schema::table('Cabangs', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('Users')
						->onDelete('no action')
						->onUpdate('no action');
        });
        Schema::table('Spesialprices', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('Users')
						->onDelete('no action')
						->onUpdate('no action');
        });
        Schema::table('Suppliers', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('Users')
						->onDelete('no action')
						->onUpdate('no action');
        });
        Schema::table('Transaksi_Penjualans', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('Users')
						->onDelete('no action')
						->onUpdate('no action');
        });
        Schema::table('Sub_Tpenjualans', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('Users')
						->onDelete('no action')
						->onUpdate('no action');
        });
        Schema::table('Spesialpricesgroups', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('Users')
						->onDelete('no action')
                        ->onUpdate('no action');
        });
        Schema::table('Angsurans', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('Users')
						->onDelete('no action')
						->onUpdate('no action');
        });
        Schema::table('Transaksi_Pengeluarans', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('Users')
						->onDelete('no action')
						->onUpdate('no action');
        });
        Schema::table('Transaksi_Pengeluarans', function(Blueprint $table) {
			$table->foreign('clientuser_id')->references('id')->on('Users')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('Sub_Tpengeluarans', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('Users')
						->onDelete('no action')
						->onUpdate('no action');
        });
        Schema::table('Angsuran_Pengeluarans', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('Users')
						->onDelete('no action')
						->onUpdate('no action');
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
