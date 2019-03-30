<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScenarioUserTable extends Migration {
    public function up() {
        Schema::create('scenario_user', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer("user_id");
            $table->integer("scenario_id");
        });
    }

    public function down() {
        Schema::dropIfExists('scenario_user');
    }
}
