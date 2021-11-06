<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToAppRoleMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('app_role_menus', function (Blueprint $table) {
            $table->foreign(['menu_id'])->references(['id'])->on('app_menus')->onDelete('CASCADE');
            $table->foreign(['role_id'])->references(['id'])->on('roles')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('app_role_menus', function (Blueprint $table) {
            $table->dropForeign('app_role_menus_menu_id_foreign');
            $table->dropForeign('app_role_menus_role_id_foreign');
        });
    }
}
