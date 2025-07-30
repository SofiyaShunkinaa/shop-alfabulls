<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAvatarToProfilesTable extends Migration
{
    public function up()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->string('avatar')->nullable()->after('user_id');
        });
    }
    
    public function down()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn('avatar');
        });
    }
}
