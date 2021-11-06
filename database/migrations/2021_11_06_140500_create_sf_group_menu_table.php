<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSfGroupMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sf_group_menu', function (Blueprint $table) {
            $table->integer('groupMenuId', true);
            $table->integer('groupId')->nullable()->index('groupId');
            $table->integer('menuId')->nullable()->index('menuId');
            $table->integer('menuInc')->nullable();
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
        Schema::dropIfExists('sf_group_menu');
    }
}
