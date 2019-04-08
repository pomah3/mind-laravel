<?php

use App\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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

        User::students()->get()->each(function($a) {
            $a->studentInfo->save();
        });
    }

    public function down() {
        Schema::dropIfExists('student_infos');
    }
}
