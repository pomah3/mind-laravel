<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDutiesTable extends Migration
{
    public function up()
    {
        Schema::create('duties', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer("user_id");
            $table->string("weekday");
            $table->datetime("from_time");
            $table->datetime("till_time");
        });
    }

    public function down()
    {
        Schema::dropIfExists('duties');
    }
}
