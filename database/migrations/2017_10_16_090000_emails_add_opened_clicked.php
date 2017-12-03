<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EmailsAddOpenedClicked extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('emails', function (Blueprint $table) {
            $table->dateTime('opened_at')->nullable();
            $table->dateTime('clicked_at')->nullable();
            $table->dateTime('unsubscribed_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('emails', function (Blueprint $table) {
            $table->dropColumn('opened_at');
            $table->dropColumn('clicked_at');
            $table->dropColumn('unsubscribed_at');
        });
    }
}
