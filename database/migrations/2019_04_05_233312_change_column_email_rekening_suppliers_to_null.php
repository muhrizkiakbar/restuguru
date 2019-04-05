<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnEmailRekeningSuppliersToNull extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('Suppliers', function (Blueprint $table) {
            // $table->dropColumn(['rekening_suppliers', 'email_supplier']);
			$table->string('rekening_suppliers', 30)->nullable()->change();
			$table->string('email_supplier', 160)->nullable()->change();
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
        Schema::table('Suppliers', function (Blueprint $table) {
            $table->string('rekening_suppliers', 30)->nullable(false)->change();
			$table->string('email_supplier', 160)->nullable(false)->change();
        });
    }
}
