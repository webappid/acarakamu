<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdsEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads_event', function (Blueprint $table) {
            $table->bigInteger('adsEventId', true);
            $table->bigInteger('adsEventEventId')->index('adsEventEventId');
            $table->bigInteger('adsEventAdsOrderId')->index('adsEventAdsOrderId');
            $table->integer('adsEventHitNumber');
            $table->timestamp('adsEventDateChange')->useCurrentOnUpdate()->useCurrent();
            $table->bigInteger('adsEventUserId')->index('adsEventUserId');
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
        Schema::dropIfExists('ads_event');
    }
}
