<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToProvincesRefTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('provinces_ref', function (Blueprint $table) {
            $table->foreign(['provincesRefUserId'], 'provinces_ref_ibfk_1')->references(['userId'])->on('sf_user')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('provinces_ref', function (Blueprint $table) {
            $table->dropForeign('provinces_ref_ibfk_1');
        });
    }
}
