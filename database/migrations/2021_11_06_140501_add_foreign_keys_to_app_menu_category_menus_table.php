<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToAppMenuCategoryMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('app_menu_category_menus', function (Blueprint $table) {
            $table->foreign(['menu_category_id'])->references(['id'])->on('app_menu_categories')->onDelete('CASCADE');
            $table->foreign(['menu_id'])->references(['id'])->on('app_menus')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('app_menu_category_menus', function (Blueprint $table) {
            $table->dropForeign('app_menu_category_menus_menu_category_id_foreign');
            $table->dropForeign('app_menu_category_menus_menu_id_foreign');
        });
    }
}
