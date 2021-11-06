<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSfMenuLanguageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sf_menu_language', function (Blueprint $table) {
            $table->increments('menuLangId');
            $table->integer('languageId')->nullable()->index('FK_menu_language_lang');
            $table->integer('menuId')->nullable()->index('FK_menu_language_menu');
            $table->string('displayMenu', 30)->nullable();
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
        Schema::dropIfExists('sf_menu_language');
    }
}
