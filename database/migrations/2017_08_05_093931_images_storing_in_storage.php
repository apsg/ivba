<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ImagesStoringInStorage extends Migration
{
    public function up()
    {
        Schema::table('images', function (Blueprint $table) {
            $table->string('filename')->nullable();
            $table->dropColumn('hash');
        });
    }

    public function down()
    {
        Schema::table('images', function (Blueprint $table) {
            $table->dropColumn('filename');
            $table->string('hash');
        });
    }
}
