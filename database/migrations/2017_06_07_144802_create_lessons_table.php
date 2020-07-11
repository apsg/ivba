<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('user_id');
            $table->string('slug');

            $table->string('title');
            $table->text('introduction');

            $table->text('description');

            $table->decimal('price', 6, 2)->default(0);
            $table->unsignedInteger('duration')->default(0);

            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();

            $table->unsignedInteger('image_id')->nullable();

            $table->tinyInteger('difficulty')->unsigned()->default(0);

            $table->foreign('image_id')->references('id')->on('images');
            $table->foreign('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('lessons');
    }
}
