<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('image', function (Blueprint $table) {
            $table->foreign(['imageUserId'], 'image_ibfk_1')->references(['userId'])->on('sf_user')->onUpdate('CASCADE');
            $table->foreign(['imageOwnerUserId'], 'image_ibfk_2')->references(['userId'])->on('sf_user')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('image', function (Blueprint $table) {
            $table->dropForeign('image_ibfk_1');
            $table->dropForeign('image_ibfk_2');
        });
    }
}
