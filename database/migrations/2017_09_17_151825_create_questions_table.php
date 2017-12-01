<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('quiz_id');
            $table->foreign('quiz_id')
                ->references('id')->on('quizzes')
                ->onDelete('cascade');

            $table->unsignedInteger('type')->default(0);

            $table->string('title');
            $table->text('content');

            $table->unsignedInteger('points')->default(1);
            $table->unsignedInteger('position')->default(0);
            
            $table->string('answer')->nullable();

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
        Schema::dropIfExists('questions');
    }
}
