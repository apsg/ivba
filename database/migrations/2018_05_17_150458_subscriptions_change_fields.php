<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SubscriptionsChangeFields extends Migration
{
    public function up()
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->string('profileid')->after('user_id')->nullable();
            $table->dateTime('valid_until')->after('profileid')->nullable();
        });
    }

    public function down()
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->dropColumn('profileid');
            $table->dropColumn('valid_until');
        });
    }
}
