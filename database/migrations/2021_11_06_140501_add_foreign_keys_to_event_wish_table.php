<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToEventWishTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('event_wish', function (Blueprint $table) {
            $table->foreign(['wishListEventId'], 'event_wish_ibfk_1')->references(['eventId'])->on('event')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['wishListEventMemberId'], 'event_wish_ibfk_2')->references(['memberId'])->on('member')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('event_wish', function (Blueprint $table) {
            $table->dropForeign('event_wish_ibfk_1');
            $table->dropForeign('event_wish_ibfk_2');
        });
    }
}
