<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('date_time_format', 15);
            $table->string('date_format', 15);
            $table->string('time_format', 15);
            $table->string('hour_minute_format', 15);
            $table->unsignedBigInteger('user_id')->index('app_settings_user_id_foreign')->comment('relation to users table');
            $table->unsignedBigInteger('creator_id')->index('app_settings_creator_id_foreign')->comment('relation to users table');
            $table->unsignedBigInteger('owner_id')->index('app_settings_owner_id_foreign')->comment('relation to users table');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_settings');
    }
}
