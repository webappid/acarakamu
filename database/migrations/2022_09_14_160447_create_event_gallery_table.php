<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventGalleryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_gallery', function (Blueprint $table) {
            $table->bigInteger('eventGalleryId', true);
            $table->bigInteger('eventGalleryEventId')->index('eventGalleryEventId');
            $table->bigInteger('eventGalleryImageId')->index('eventGalleryImageId');
            $table->timestamp('eventGalleryDateChange')->useCurrentOnUpdate()->useCurrent();
            $table->bigInteger('eventGalleryUserId');
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
        Schema::dropIfExists('event_gallery');
    }
}
