<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CoursesAddScheduleForSpecial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->timestamp('scheduled_at')->nullable();
        });

        Schema::table('course_lesson', function (Blueprint $table) {
            $table->tinyInteger('delay')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn('scheduled_at');
        });

        Schema::table('course_lesson', function (Blueprint $table) {
            $table->dropColumn('delay');
        });
    }
}
