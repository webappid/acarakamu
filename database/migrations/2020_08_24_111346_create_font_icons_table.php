<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFontIconsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('font_icons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedSmallInteger('type_id')
                ->comment('Relation to font icon types table');
            $table->string('name')
                ->index()
                ->comment('font icon name');
            $table->timestamps();

            /**
             * relation
             */

            $table->foreign('type_id')->references('id')->on('font_icon_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('font_icons');
    }
}
