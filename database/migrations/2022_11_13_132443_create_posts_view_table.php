<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsViewTable extends Migration
{
    public function up()
    {
        Schema::create('post_displays', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->unsignedInteger('post_id');
            $table->foreign('post_id')
                ->references('id')
                ->on('posts')
                ->cascadeOnDelete();

            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->boolean('has_seen_posts')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_displays');

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('has_seen_posts');
        });
    }
}
