<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class QuickSalesRequireFullData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quick_sales', function (Blueprint $table) {
            $table->boolean('is_full_data_required')->default(false);
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
            $table->dropColumn('is_full_data_required');
        });
    }
}
