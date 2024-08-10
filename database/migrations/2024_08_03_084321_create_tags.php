<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTags extends Migration
{
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('color', 10);
            $table->boolean('is_hidden')->default(false);

            $table->timestamps();
        });

        Schema::create('course_tag', function (Blueprint $table) {
            $table->integer('course_id')->unsigned();
            $table->foreign('course_id')
                ->references('id')
                ->on('courses')
                ->onDelete('cascade');

            $table->integer('tag_id')->unsigned();
            $table->foreign('tag_id')
                ->references('id')
                ->on('tags')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('course_tag');
        Schema::dropIfExists('tags');
    }
}
