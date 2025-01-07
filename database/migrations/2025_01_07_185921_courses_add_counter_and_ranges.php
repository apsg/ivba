<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CoursesAddCounterAndRanges extends Migration
{
    public function up()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->string('promo_counter')->nullable();
            $table->string('promo_text')->nullable();

            $table->string('salary_range')->nullable();
            $table->string('salary_skills')->nullable();
            $table->string('salary_cta')->nullable();
        });
    }

    public function down()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn('promo_counter');
            $table->dropColumn('promo_text');

            $table->dropColumn('salary_range');
            $table->dropColumn('salary_skills');
            $table->dropColumn('salary_cta');
        });
    }
}
