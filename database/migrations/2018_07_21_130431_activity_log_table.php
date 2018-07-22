<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ActivityLogTable extends Migration {
    public function up()
    {
        Schema::create('activity_log', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('log', 200);
		});
    }

    public function down()
    {
        Schema::drop('activity_log');
    }
}
