<?php

use App\Event;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddResponsibleToEvents extends Migration
{
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->integer("responsible_id")->nullable();
        });

        foreach (Event::all() as $event) {
            $event->responsible_id = $event->author_id;
            $event->save();
        }

        Schema::table('events', function (Blueprint $table) {
            $table->integer("responsible_id")->nullable(false)->change();
        });
    }

    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn("responsible_id");
        });
    }
}
