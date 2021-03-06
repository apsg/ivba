<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class QsAddBaselinker extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quick_sales', function (Blueprint $table) {
            $table->string('baselinker_id')->nullable();
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
            $table->dropColumn('baselinker_id');
        });
    }
}
