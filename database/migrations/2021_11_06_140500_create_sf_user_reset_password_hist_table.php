<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSfUserResetPasswordHistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sf_user_reset_password_hist', function (Blueprint $table) {
            $table->bigInteger('userResetPasswordHistId', true);
            $table->bigInteger('userResetPasswordHistUserId')->index('userResetPasswordHistUserName');
            $table->string('userResetPasswordHistCode', 20);
            $table->dateTime('userResetPasswordHistValidUntil');
            $table->enum('userResetPasswordHistStatus', ['unused', 'used'])->default('unused');
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
        Schema::dropIfExists('sf_user_reset_password_hist');
    }
}
