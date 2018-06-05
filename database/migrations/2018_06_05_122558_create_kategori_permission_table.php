<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKategoriPermissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kategori_permission', function (Blueprint $table) {
            $table->integer('kategori_id')->unsigned();
            $table->integer('permission_id')->unsigned();

            $table->foreign('kategori_id')->references('id')->on('kategorimenu')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('permission_id')->references('id')->on('permissions')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['kategori_id', 'permission_id']);
        });

        // Create table for associating roles to users (Many-to-Many)
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kategori_permission');
    }
}
