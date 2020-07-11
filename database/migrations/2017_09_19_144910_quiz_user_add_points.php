<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class QuizUserAddPoints extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quiz_user', function (Blueprint $table) {
            $table->unsignedInteger('points')->nullable()->after('pass_date');
            $table->renameColumn('pass_date', 'finished_date');
            $table->boolean('is_pass')->default(false)->after('points');
        });

        Schema::table('answers', function (Blueprint $table) {
            $table->unsignedInteger('points')->default(0)->after('is_correct');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quiz_user', function (Blueprint $table) {
            $table->dropColumn('points');
            $table->dropColumn('is_pass');
            $table->renameColumn('finished_date', 'pass_date');
        });

        Schema::table('answers', function (Blueprint $table) {
            $table->dropColumn('points');
        });
    }
}
