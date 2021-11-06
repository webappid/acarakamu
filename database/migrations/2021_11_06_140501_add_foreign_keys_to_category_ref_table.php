<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToCategoryRefTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('category_ref', function (Blueprint $table) {
            $table->foreign(['categoryUserId'], 'category_ref_ibfk_1')->references(['userId'])->on('sf_user')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('category_ref', function (Blueprint $table) {
            $table->dropForeign('category_ref_ibfk_1');
        });
    }
}
