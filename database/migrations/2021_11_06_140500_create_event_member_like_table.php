<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventMemberLikeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_member_like', function (Blueprint $table) {
            $table->bigInteger('eventMemberLikeId', true);
            $table->bigInteger('eventMemberLikeEventId');
            $table->bigInteger('eventMemberLikeMemberId');
            $table->tinyInteger('eventMemberLikeStars')->default(5);
            $table->timestamp('eventMemberLikeDateChange')->useCurrentOnUpdate()->useCurrent();
            $table->bigInteger('eventMemberLikeUserId');
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
        Schema::dropIfExists('event_member_like');
    }
}
