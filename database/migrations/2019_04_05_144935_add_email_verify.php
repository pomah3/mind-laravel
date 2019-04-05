<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEmailVerify extends Migration {
    public function up() {
        Schema::table('users', function (Blueprint $table) {
            $table->timestamp("email_verified_at")->nullable();
        });
    }

    public function down() {
        Schema::table('users', function (Blueprint $table) {
            $table->timestamp('email_verified_at');
        });
    }
}
