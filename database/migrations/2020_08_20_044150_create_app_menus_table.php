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
            $table->bigInteger('parent_id')
                ->nullable(true)
                ->comment('Parent from menu');
            $table->string('name', 100)
                ->unique()
                ->comment('menu name');
            $table->unsignedBigInteger('route_id')
                ->nullable(true)
                ->comment('default route for menu');
            $table->string('icon',20)
                ->nullable(true)
                ->default('')
                ->comment('menu icon');
            $table->enum('is_active',['true', 'false'])
                ->nullable(false)
                ->default('true');
            $table->timestamps();

            /**
             * relation
             */

            $table->foreign('route_id')->references('id')->on('app_routes');
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
