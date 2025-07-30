<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateOrdersTable2 extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('orders', function (Blueprint $table) {
            $table->bigInteger('delivery_id')->unsigned()->nullable();
            $table->foreign('delivery_id')->references('id')->on('deliveries');
            $table->decimal('delivery_amount', 7, 2)->default(0);
            $table->string('delivery_tracknumber')->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign('orders_delivery_id_foreign');
            $table->dropColumn('delivery_id');
            $table->dropColumn('delivery_amount');
            $table->dropColumn('delivery_tracknumber');
        });
    }
}
