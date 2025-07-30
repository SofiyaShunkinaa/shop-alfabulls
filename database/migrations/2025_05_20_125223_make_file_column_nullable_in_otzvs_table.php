<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeFileColumnNullableInOtzvsTable extends Migration
{
    public function up()
    {
        Schema::table('otzvs', function (Blueprint $table) {
            $table->string('file')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('otzvs', function (Blueprint $table) {
            $table->string('file')->nullable(false)->change();
        });
    }
}
