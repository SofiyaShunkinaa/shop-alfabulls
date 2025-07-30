<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBasketPromoTable extends Migration
{
public function up()
{
    // TODO
    if (!Schema::hasTable('basket_promo')) {
        Schema::create('basket_promo', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('basket_id');
            $table->unsignedBigInteger('promo_id');
            
            // Внешние ключи
            $table->foreign('basket_id')->references('id')->on('baskets')->onDelete('cascade');
            $table->foreign('promo_id')->references('id')->on('promos')->onDelete('cascade');
            
            $table->timestamps();
        });
    }
}

public function down()
{
    Schema::dropIfExists('basket_promo');
}
}
