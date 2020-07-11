<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emails', function (Blueprint $table) {
            $table->increments('id');

            $table->string('from');

            $table->unsignedInteger('to_id');
            $table->string('to_type');

            $table->string('title');
            $table->text('body');

            $table->datetime('send_at');
            $table->boolean('is_sent');
            $table->unsignedInteger('type')->default(0);

            $table->string('attachment')->nullable();

            $table->string('unsubscribe_code')->unique()->nullable();

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
        Schema::dropIfExists('emails');
    }
}
