<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToCityRefTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('city_ref', function (Blueprint $table) {
            $table->foreign(['cityUserId'], 'city_ref_ibfk_1')->references(['userId'])->on('sf_user')->onUpdate('CASCADE');
            $table->foreign(['cityProvincesRefId'], 'city_ref_ibfk_2')->references(['provincesRefId'])->on('provinces_ref')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('city_ref', function (Blueprint $table) {
            $table->dropForeign('city_ref_ibfk_1');
            $table->dropForeign('city_ref_ibfk_2');
        });
    }
}
