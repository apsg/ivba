<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class QuicksalesAddRedirectUrl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quick_sales', function (Blueprint $table) {
            $table->string('redirect_url')->nullable();
            $table->unsignedInteger('course_id')->nullable()->change();
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
            $table->dropColumn('redirect_url');
            $table->unsignedInteger('course_id')->change();
        });
    }
}
