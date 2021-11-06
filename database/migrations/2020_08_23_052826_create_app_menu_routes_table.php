<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppMenuRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_menu_routes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('menu_id')
                ->nullable(false)
                ->comment('relation to app menu');
            $table->unsignedBigInteger('route_id')
                ->nullable(false)
                ->comment('relation to app route');
            $table->timestamps();

            /**
             * relation
             */

            $table->foreign('menu_id')->references('id')->on('app_menus')->onDelete('cascade');
            $table->foreign('route_id')->references('id')->on('app_routes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_menu_routes');
    }
}
