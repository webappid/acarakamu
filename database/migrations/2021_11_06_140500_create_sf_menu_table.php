<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSfMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sf_menu', function (Blueprint $table) {
            $table->integer('menuId', true);
            $table->string('menuName', 25)->nullable();
            $table->string('menuPath')->nullable();
            $table->integer('moduleId')->nullable();
            $table->integer('parentLink')->nullable();
            $table->string('menuIcon', 50)->nullable();
            $table->tinyInteger('order')->nullable();
            $table->integer('userId')->nullable();
            $table->dateTime('dateChange')->nullable();
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
        Schema::dropIfExists('sf_menu');
    }
}
