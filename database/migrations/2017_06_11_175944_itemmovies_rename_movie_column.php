<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ItemmoviesRenameMovieColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('item_movies', function (Blueprint $table) {
            $table->dropColumn('movie_id');
            $table->unsignedInteger('video_id');

            $table->foreign('video_id')->references('id')->on('videos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('item_movies', function (Blueprint $table) {
            $table->dropForeign(['video_id']);

            $table->dropColumn('video_id');
            $table->unsignedInteger('movie_id');
        });
    }
}
