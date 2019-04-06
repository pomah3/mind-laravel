<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLastVisit extends Migration {
    public function up() {
        Schema::table('users', function (Blueprint $table) {
            $table->dateTime("last_visit")->nullable();
        });
    }

    public function down() {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('last_visit');
        });
    }
}
