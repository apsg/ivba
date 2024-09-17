<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CoursesAddAuthors extends Migration
{
    public function up()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->integer('author_id')->unsigned()->nullable();
            $table->foreign('author_id')
                ->references('id')
                ->on('authors')
                ->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropForeign(['author_id']);
            $table->dropColumn('author_id');
        });
    }
}
