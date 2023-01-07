<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DisplayRemoveForeignAndPosts extends Migration
{
    public function up()
    {
        Schema::table('post_displays', function (Blueprint $table) {
            $table->dropForeign('post_displays_post_id_foreign');
        });

        Schema::dropIfExists('posts');
    }

    public function down()
    {
        Schema::table('post_displays', function (Blueprint $table) {
            $table->foreign('post_id')
                ->references('id')
                ->on('posts')
                ->onDelete('cascade');
        });
    }
}
