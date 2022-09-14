<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('event', function (Blueprint $table) {
            $table->foreign(['eventOwnerUserId'], 'event_ibfk_1')->references(['userId'])->on('sf_user')->onUpdate('CASCADE');
            $table->foreign(['eventUserId'], 'event_ibfk_2')->references(['userId'])->on('sf_user')->onUpdate('CASCADE');
            $table->foreign(['eventCoverImageId'], 'event_ibfk_3')->references(['imageId'])->on('image')->onUpdate('CASCADE');
            $table->foreign(['eventStatusId'], 'event_ibfk_4')->references(['eventStatusId'])->on('event_status_ref')->onUpdate('CASCADE');
            $table->foreign(['eventCategoryId'], 'event_ibfk_5')->references(['categoryId'])->on('category_ref')->onUpdate('CASCADE');
            $table->foreign(['eventCityId'], 'event_ibfk_6')->references(['cityId'])->on('city_ref')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('event', function (Blueprint $table) {
            $table->dropForeign('event_ibfk_1');
            $table->dropForeign('event_ibfk_2');
            $table->dropForeign('event_ibfk_3');
            $table->dropForeign('event_ibfk_4');
            $table->dropForeign('event_ibfk_5');
            $table->dropForeign('event_ibfk_6');
        });
    }
}
