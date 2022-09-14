<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventWishTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_wish', function (Blueprint $table) {
            $table->bigInteger('wishListId', true);
            $table->bigInteger('wishListEventId');
            $table->bigInteger('wishListEventMemberId')->index('wishListEventMemberId');
            $table->timestamps();

            $table->unique(['wishListEventId', 'wishListEventMemberId'], 'wishListEventId');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_wish');
    }
}
