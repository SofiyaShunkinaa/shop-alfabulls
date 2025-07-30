<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBasketBonusPoints extends Migration
{

    public function up()
    {
        Schema::create('basket_bonus_points', function (Blueprint $table) {
            $table->id();
            $table->integer('bonus_amount')->nullable();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('basket_id');
            
            // Внешние ключи
            $table->foreign('basket_id')->references('id')->on('baskets')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('basket_bonus_points');
    }
}
