<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToEventHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('event_history', function (Blueprint $table) {
            $table->foreign(['eventHitoryEventId'], 'event_history_ibfk_1')->references(['eventId'])->on('event')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['eventHistoryStatusId'], 'event_history_ibfk_2')->references(['eventStatusId'])->on('event_status_ref')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['eventHistoryUserId'], 'event_history_ibfk_3')->references(['userId'])->on('sf_user')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('event_history', function (Blueprint $table) {
            $table->dropForeign('event_history_ibfk_1');
            $table->dropForeign('event_history_ibfk_2');
            $table->dropForeign('event_history_ibfk_3');
        });
    }
}
