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
            $table->unsignedBigInteger('menu_category_id')
                ->nullable(false)
                ->comment('relation to app menu categories table');
            $table->unsignedBigInteger('menu_id')
                ->nullable(false)
                ->comment('relation to app menus table');
            $table->timestamps();

            /**
             * relation
             */

            $table->foreign('menu_category_id')->references('id')->on('app_menu_categories')->cascadeOnDelete();
            $table->foreign('menu_id')->references('id')->on('app_menus')->cascadeOnDelete();
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
