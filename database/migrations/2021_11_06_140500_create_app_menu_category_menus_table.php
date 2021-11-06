<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppMenuCategoryMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_menu_category_menus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('menu_category_id')->index('app_menu_category_menus_menu_category_id_foreign')->comment('relation to app menu categories table');
            $table->unsignedBigInteger('menu_id')->index('app_menu_category_menus_menu_id_foreign')->comment('relation to app menus table');
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
        Schema::dropIfExists('app_menu_category_menus');
    }
}
