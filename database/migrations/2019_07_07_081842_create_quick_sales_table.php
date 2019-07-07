<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuickSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quick_sales', function (Blueprint $table) {
            $table->increments('id');
            $table->string('hash')->nullable();

            $table->string('name');
            $table->text('description')->nullable();
            $table->string('rules_url');

            $table->float('price', 6, 2);
            $table->float('full_price', 6, 2)->nullable();

            $table->unsignedInteger('course_id');
            $table->foreign('course_id')
                ->references('id')
                ->on('courses')
                ->onDelete('CASCADE');

            $table->string('message_email')->nullable();
            $table->string('message_subject')->nullable();
            $table->text('message_body')->nullable();

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
        Schema::dropIfExists('quick_sales');
    }
}
