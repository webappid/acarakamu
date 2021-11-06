<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_menus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('parent_id')->nullable()->comment('Parent from menu');
            $table->string('name', 100)->unique()->comment('menu name');
            $table->unsignedBigInteger('route_id')->nullable()->index('app_menus_route_id_foreign')->comment('default route for menu');
            $table->string('icon', 100)->nullable()->default('')->comment('menu icon');
            $table->integer('menu_order')->default(1);
            $table->enum('is_active', ['true', 'false'])->default('true');
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
        Schema::dropIfExists('app_menus');
    }
}
