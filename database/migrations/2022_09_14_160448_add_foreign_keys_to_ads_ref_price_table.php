<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToAdsRefPriceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ads_ref_price', function (Blueprint $table) {
            $table->foreign(['adsPriceRefUserId'], 'ads_ref_price_ibfk_1')->references(['userId'])->on('sf_user')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ads_ref_price', function (Blueprint $table) {
            $table->dropForeign('ads_ref_price_ibfk_1');
        });
    }
}
