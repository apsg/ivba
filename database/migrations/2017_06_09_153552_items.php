<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Items extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->unsignedInteger('lesson_id');

            $table->unsignedInteger('items_id');
            $table->string('items_type');

            $table->unsignedInteger('position')->default(0);

            $table->foreign('lesson_id')->references('id')->on('lessons')->onDelete('cascade');

            $table->unique(['lesson_id', 'items_id', 'items_type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
