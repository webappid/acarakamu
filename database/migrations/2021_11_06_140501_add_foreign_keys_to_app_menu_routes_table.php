<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToAppMenuRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('app_menu_routes', function (Blueprint $table) {
            $table->foreign(['menu_id'])->references(['id'])->on('app_menus')->onDelete('CASCADE');
            $table->foreign(['route_id'])->references(['id'])->on('app_routes')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('app_menu_routes', function (Blueprint $table) {
            $table->dropForeign('app_menu_routes_menu_id_foreign');
            $table->dropForeign('app_menu_routes_route_id_foreign');
        });
    }
}
