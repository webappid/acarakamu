<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToFontIconsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('font_icons', function (Blueprint $table) {
            $table->foreign(['type_id'])->references(['id'])->on('font_icon_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('font_icons', function (Blueprint $table) {
            $table->dropForeign('font_icons_type_id_foreign');
        });
    }
}
