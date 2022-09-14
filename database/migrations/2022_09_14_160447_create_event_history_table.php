<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_history', function (Blueprint $table) {
            $table->bigInteger('eventHistoryId', true);
            $table->bigInteger('eventHitoryEventId')->index('eventHitoryEventId');
            $table->smallInteger('eventHistoryStatusId')->index('eventHistoryStatusId');
            $table->string('eventHistoryMessage');
            $table->timestamp('eventHistoryDateTime')->useCurrentOnUpdate()->useCurrent();
            $table->bigInteger('eventHistoryUserId')->index('eventHistoryUserId');
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
        Schema::dropIfExists('event_history');
    }
}
