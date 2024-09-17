<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AuthorsAddBio extends Migration
{
    public function up()
    {
        Schema::table('authors', function (Blueprint $table) {
            $table->text('bio')->nullable();
        });
    }

    public function down()
    {
        Schema::table('authors', function (Blueprint $table) {
            $table->dropColumn('bio');
        });
    }
}
