<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToAdsOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ads_order', function (Blueprint $table) {
            $table->foreign(['adsOrderUserId'], 'ads_order_ibfk_1')->references(['userId'])->on('sf_user')->onUpdate('CASCADE');
            $table->foreign(['adsOrderStatusId'], 'ads_order_ibfk_2')->references(['orderStatusId'])->on('order_status')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ads_order', function (Blueprint $table) {
            $table->dropForeign('ads_order_ibfk_1');
            $table->dropForeign('ads_order_ibfk_2');
        });
    }
}
