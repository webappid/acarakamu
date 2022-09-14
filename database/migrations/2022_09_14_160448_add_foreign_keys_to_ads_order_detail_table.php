<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToAdsOrderDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ads_order_detail', function (Blueprint $table) {
            $table->foreign(['adsOrderDetailAdsOrderId'], 'ads_order_detail_ibfk_1')->references(['adsOrderId'])->on('ads_order')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['adsOrderDetailAdsEventId'], 'ads_order_detail_ibfk_2')->references(['eventId'])->on('event')->onUpdate('CASCADE');
            $table->foreign(['adsOrderDetailAdsRefPriceId'], 'ads_order_detail_ibfk_3')->references(['adsPriceRefId'])->on('ads_ref_price')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ads_order_detail', function (Blueprint $table) {
            $table->dropForeign('ads_order_detail_ibfk_1');
            $table->dropForeign('ads_order_detail_ibfk_2');
            $table->dropForeign('ads_order_detail_ibfk_3');
        });
    }
}
