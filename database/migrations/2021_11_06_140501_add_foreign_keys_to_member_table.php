<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('member', function (Blueprint $table) {
            $table->foreign(['memberImageId'], 'member_ibfk_1')->references(['imageId'])->on('image')->onUpdate('CASCADE');
            $table->foreign(['memberUserId'], 'member_ibfk_2')->references(['userId'])->on('sf_user')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('member', function (Blueprint $table) {
            $table->dropForeign('member_ibfk_1');
            $table->dropForeign('member_ibfk_2');
        });
    }
}
