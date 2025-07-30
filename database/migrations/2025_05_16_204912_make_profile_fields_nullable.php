<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeProfileFieldsNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->string('title')->nullable()->change();
            $table->string('name')->nullable()->change();
            $table->string('email')->nullable()->change();
            $table->string('phone')->nullable()->change();
            $table->string('address')->nullable()->change();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->string('title')->nullable(false)->change();
            $table->string('name')->nullable(false)->change();
            $table->string('email')->nullable(false)->change();
            $table->string('phone')->nullable(false)->change();
            $table->string('address')->nullable(false)->change();
        });
    }
}
