<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdsRefPriceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads_ref_price', function (Blueprint $table) {
            $table->integer('adsPriceRefId', true);
            $table->string('adsPriceRefCode', 10)->default('');
            $table->decimal('adsPriceRefValue', 10, 0)->default(0);
            $table->integer('adsPriceRefClick')->default(0);
            $table->timestamp('adsPriceRefDateChange')->useCurrentOnUpdate()->useCurrent();
            $table->bigInteger('adsPriceRefUserId')->index('adsPriceRefUserId');
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
        Schema::dropIfExists('ads_ref_price');
    }
}
