<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdsOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads_order', function (Blueprint $table) {
            $table->bigInteger('adsOrderId', true);
            $table->string('adsOrderNumber', 50);
            $table->dateTime('adsOrderDateOrder');
            $table->smallInteger('adsOrderStatusId')->index('adsOrderStatusId');
            $table->dateTime('adsOrderDateChange')->nullable();
            $table->smallInteger('adsOrderQty');
            $table->decimal('adsOrderTotal', 10, 0);
            $table->bigInteger('adsOrderUserId')->index('adsOrderUserId');
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
        Schema::dropIfExists('ads_order');
    }
}
