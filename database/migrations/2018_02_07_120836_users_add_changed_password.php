<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UsersAddChangedPassword extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dateTime('changed_password_at')->nullable();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('changed_password_at');
        });
    }
}
