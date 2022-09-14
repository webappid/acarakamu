<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToSfGroupMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sf_group_menu', function (Blueprint $table) {
            $table->foreign(['groupId'], 'sf_group_menu_ibfk_1')->references(['groupId'])->on('sf_group');
            $table->foreign(['menuId'], 'sf_group_menu_ibfk_2')->references(['menuId'])->on('sf_menu');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sf_group_menu', function (Blueprint $table) {
            $table->dropForeign('sf_group_menu_ibfk_1');
            $table->dropForeign('sf_group_menu_ibfk_2');
        });
    }
}
