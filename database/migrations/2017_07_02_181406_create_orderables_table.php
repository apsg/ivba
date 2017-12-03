<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orderables', function (Blueprint $table) {
            
            $table->unsignedInteger('order_id');

            $table->foreign('order_id')->references('id')->on('orders');

            $table->string('orderable_type');
            $table->unsignedInteger('orderable_id');

            $table->unique(['order_id', 'orderable_type', 'orderable_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orderables', function (Blueprint $table) {
            $table->dropForeign(['order_id']);
        });

        Schema::dropIfExists('orderables');
    }
}
