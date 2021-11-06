<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToSfUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sf_user', function (Blueprint $table) {
            $table->foreign(['groupId'], 'sf_user_ibfk_1')->references(['groupId'])->on('sf_group');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sf_user', function (Blueprint $table) {
            $table->dropForeign('sf_user_ibfk_1');
        });
    }
}
