<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToAppMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('app_menus', function (Blueprint $table) {
            $table->foreign(['route_id'])->references(['id'])->on('app_routes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('app_menus', function (Blueprint $table) {
            $table->dropForeign('app_menus_route_id_foreign');
        });
    }
}
