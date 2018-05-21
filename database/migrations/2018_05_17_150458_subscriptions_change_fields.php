<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SubscriptionsChangeFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            // $table->dropColumn('amount');
            // $table->dropColumn('duration');
            // $table->dropColumn('next_payment_at');

            $table->string('profileid')->after('user_id');
            $table->dateTime('valid_until')->after('profileid')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            
            $table->dropColumn('profileid');
            $table->dropColumn('valid_until');
        });
    }
}
