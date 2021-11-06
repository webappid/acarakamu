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
            $table->unsignedBigInteger('user_id')
                ->comment('relation to users table');
            $table->unsignedBigInteger('creator_id')
                ->comment('relation to users table');
            $table->unsignedBigInteger('owner_id')
                ->comment('relation to users table');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('owner_id')->references('id')->on('users');
            $table->foreign('creator_id')->references('id')->on('users');

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
