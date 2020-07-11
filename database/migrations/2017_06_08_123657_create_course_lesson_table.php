<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseLessonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_lesson', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('course_id');
            $table->unsignedInteger('lesson_id');

            $table->unsignedInteger('order')->default(0);

            $table->foreign('course_id')->references('id')->on('courses')->odDelete('cascade');
            $table->foreign('lesson_id')->references('id')->on('lessons')->odDelete('cascade');

            $table->unique(['course_id', 'lesson_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('course_lesson', function (Blueprint $table) {
            $table->dropForeign(['course_id']);
            $table->dropForeign(['lesson_id']);
        });

        Schema::dropIfExists('course_lesson');
    }
}
