<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('subscription_id');
            $table->string('title');
            $table->float('amount', 5, 2);
            $table->string('external_id')->nullable();

            $table->dateTime('confirmed_at')->nullable();
            $table->dateTime('cancelled_at')->nullable();

            $table->boolean('is_recurrent')->default(0);

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
        Schema::dropIfExists('payments');
    }
}
