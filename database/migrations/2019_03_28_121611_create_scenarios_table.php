<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScenariosTable extends Migration {
    public function up() {
        Schema::create('scenarios', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string("stage");
            $table->string("type");
            $table->text("data");
            $table->integer("user_id");
        });
    }

    public function down() {
        Schema::dropIfExists('scenarios');
    }
}
