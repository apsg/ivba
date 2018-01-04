<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CoursesAddOrderAndDelay extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->unsignedInteger('position')->default(0);
            $table->unsignedInteger('delay')->default(0)->comment = 'Liczba dni';
            $table->unsignedInteger('cumulative_delay')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn('position');
            $table->dropColumn('delay');
            $table->dropColumn('cumulative_delay');
        });
    }
}
