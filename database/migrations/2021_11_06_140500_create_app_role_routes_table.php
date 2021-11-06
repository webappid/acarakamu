<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppRoleRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_role_routes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('route_id')->comment('relation to app routes table');
            $table->unsignedInteger('role_id')->index('app_role_routes_role_id_foreign')->comment('relation to roles table');
            $table->timestamps();

            $table->index(['route_id', 'role_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_role_routes');
    }
}
