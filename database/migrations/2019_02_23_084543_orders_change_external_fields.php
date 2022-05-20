<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OrdersChangeExternalFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            try {
                $table->renameColumn('payu_order_id', 'external_payment_id');
            } catch (BadMethodCallException $exception) {
                $table->dropColumn('payu_order_id');
                $table->string('external_payment_id')->nullable();
            }
            $table->dropColumn('payu_refid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->renameColumn('external_payment_id', 'payu_order_id');
            $table->string('payu_refid')->nullable();
        });
    }
}
