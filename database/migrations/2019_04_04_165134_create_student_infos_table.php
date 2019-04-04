<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentInfosTable extends Migration {
    public function up() {
        Schema::create('student_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer("student_id")->unique();
            $table->string("room")->nullable();
            $table->tinyInteger("level")->nullable();
            $table->string("phone")->nullable();
            $table->date("birthday")->nullable();
        });
    }

    public function down() {
        Schema::dropIfExists('student_infos');
    }
}
