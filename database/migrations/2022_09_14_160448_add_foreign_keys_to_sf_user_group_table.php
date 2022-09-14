<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToSfUserGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sf_user_group', function (Blueprint $table) {
            $table->foreign(['userGroupGroupId'], 'sf_user_group_ibfk_1')->references(['groupId'])->on('sf_group')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['userGroupUserId'], 'sf_user_group_ibfk_2')->references(['userId'])->on('sf_user')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sf_user_group', function (Blueprint $table) {
            $table->dropForeign('sf_user_group_ibfk_1');
            $table->dropForeign('sf_user_group_ibfk_2');
        });
    }
}
