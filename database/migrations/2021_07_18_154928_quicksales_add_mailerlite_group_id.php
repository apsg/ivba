<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class QuicksalesAddMailerliteGroupId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quick_sales', function (Blueprint $table) {
            $table->string('mailerlite_group_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quick_sales', function (Blueprint $table) {
            $table->removeColumn('mailerlite_group_id');
        });
    }
}
