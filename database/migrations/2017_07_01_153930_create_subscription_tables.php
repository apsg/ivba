<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_user', function(Blueprint $table){
            $table->increments('id');

            $table->unsignedInteger('course_id');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');

            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->datetime('finished_at')->nullable()->default(null);

            $table->unique(['course_id', 'user_id']);

            $table->timestamps();

        });

        Schema::create('lesson_user', function(Blueprint $table){
            $table->increments('id');

            $table->unsignedInteger('lesson_id');
            $table->foreign('lesson_id')->references('id')->on('lessons')->onDelete('cascade');

            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->datetime('finished_at')->nullable()->default(null);

            $table->unique(['lesson_id', 'user_id']);

            $table->timestamps();

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('course_user', function(Blueprint $table){
            $table->dropForeign(['user_id']);
            $table->dropForeign(['course_id']);
        });

        Schema::dropIfExists('course_user');

        Schema::table('lesson_user', function(Blueprint $table){
            $table->dropForeign(['user_id']);
            $table->dropForeign(['lesson_id']);
        });

        Schema::dropIfExists('lesson_user');
    }
}
