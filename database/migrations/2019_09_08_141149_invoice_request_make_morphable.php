<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InvoiceRequestMakeMorphable extends Migration
{
    public function up()
    {
        Schema::table('invoice_requests', function (Blueprint $table) {
            $table->dropForeign(['order_id']);

            try {
                $table->renameColumn('order_id', 'invoicable_id');
            } catch (BadMethodCallException $exception) {
                $table->dropColumn('order_id');
                $table->unsignedInteger('invoicable_id')->nullable();
            }

            $table->string('invoicable_type')->default('App\\Order');
            $table->unique(['invoicable_id', 'invoicable_type']);
        });
    }

    public function down()
    {
        Schema::table('invoice_requests', function (Blueprint $table) {
            $table->dropUnique(['invoicable_id', 'invoicable_type']);

            $table->dropColumn('invoicable_type');
            $table->renameColumn('invoicable_id', 'order_id');

            $table->foreign('order_id')
                ->references('id')
                ->on('orders')
                ->onDelete('CASCADE');
        });
    }
}
