<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToSfUserResetPasswordHistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sf_user_reset_password_hist', function (Blueprint $table) {
            $table->foreign(['userResetPasswordHistUserId'], 'sf_user_reset_password_hist_ibfk_1')->references(['userId'])->on('sf_user')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sf_user_reset_password_hist', function (Blueprint $table) {
            $table->dropForeign('sf_user_reset_password_hist_ibfk_1');
        });
    }
}
