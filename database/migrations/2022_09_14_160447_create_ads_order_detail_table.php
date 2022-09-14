<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdsOrderDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads_order_detail', function (Blueprint $table) {
            $table->bigInteger('adsOrderDetailId', true);
            $table->bigInteger('adsOrderDetailAdsOrderId')->index('adsOrderDetailAdsOrderId');
            $table->integer('adsOrderDetailAdsRefPriceId')->index('adsOrderDetailAdsRefPriceId');
            $table->bigInteger('adsOrderDetailAdsEventId')->index('adsOrderDetailAdsEventId');
            $table->smallInteger('adsOrderDetailQty');
            $table->decimal('adsOrderDetailSubTotal', 10, 0);
            $table->decimal('adsOrderDetailTotal', 10, 0);
            $table->timestamp('adsOrderDetailDateChange')->useCurrentOnUpdate()->useCurrent();
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
        Schema::dropIfExists('ads_order_detail');
    }
}
