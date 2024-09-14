<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CoursesAddTagsAndThings extends Migration
{
    public function up()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->text('topics')->nullable();
            $table->text('things')->nullable();
        });
    }

    public function down()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn('topics');
            $table->dropColumn('things');
        });
    }
}
