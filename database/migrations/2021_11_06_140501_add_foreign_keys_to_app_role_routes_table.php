<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToAppRoleRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('app_role_routes', function (Blueprint $table) {
            $table->foreign(['role_id'])->references(['id'])->on('roles')->onDelete('CASCADE');
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
        Schema::table('app_role_routes', function (Blueprint $table) {
            $table->dropForeign('app_role_routes_role_id_foreign');
            $table->dropForeign('app_role_routes_route_id_foreign');
        });
    }
}
