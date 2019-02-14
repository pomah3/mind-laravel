<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('polls', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer("creator_id");

            $table->string('title');
            $table->text('content');
            $table->text('variants');

            $table->date('till_date');
            $table->string("access_vote");
            $table->string("access_see_result");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('polls');
    }
}
