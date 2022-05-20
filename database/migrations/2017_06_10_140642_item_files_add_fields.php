<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ItemFilesAddFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('item_files', function (Blueprint $table) {
            $table->string('hash')->nullable();
            $table->unsignedInteger('host')->default(0);
            $table->string('size')->nullable();
            $table->string('name')->nullable();
            $table->string('mime')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('item_files', function (Blueprint $table) {
            $table->dropColumn('hash');
            $table->dropColumn('host');
            $table->dropColumn('size');
            $table->dropColumn('name');
            $table->dropColumn('mime');
        });
    }
}
