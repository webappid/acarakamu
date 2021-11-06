<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToAppSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('app_settings', function (Blueprint $table) {
            $table->foreign(['creator_id'])->references(['id'])->on('users');
            $table->foreign(['owner_id'])->references(['id'])->on('users');
            $table->foreign(['user_id'])->references(['id'])->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('app_settings', function (Blueprint $table) {
            $table->dropForeign('app_settings_creator_id_foreign');
            $table->dropForeign('app_settings_owner_id_foreign');
            $table->dropForeign('app_settings_user_id_foreign');
        });
    }
}
