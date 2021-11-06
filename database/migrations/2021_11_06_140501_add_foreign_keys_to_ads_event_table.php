<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToAdsEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ads_event', function (Blueprint $table) {
            $table->foreign(['adsEventEventId'], 'ads_event_ibfk_1')->references(['eventId'])->on('event')->onUpdate('CASCADE');
            $table->foreign(['adsEventAdsOrderId'], 'ads_event_ibfk_2')->references(['adsOrderId'])->on('ads_order')->onUpdate('CASCADE');
            $table->foreign(['adsEventUserId'], 'ads_event_ibfk_3')->references(['userId'])->on('sf_user')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ads_event', function (Blueprint $table) {
            $table->dropForeign('ads_event_ibfk_1');
            $table->dropForeign('ads_event_ibfk_2');
            $table->dropForeign('ads_event_ibfk_3');
        });
    }
}
