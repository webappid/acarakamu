<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToEventGalleryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('event_gallery', function (Blueprint $table) {
            $table->foreign(['eventGalleryEventId'], 'event_gallery_ibfk_1')->references(['eventId'])->on('event')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['eventGalleryImageId'], 'event_gallery_ibfk_2')->references(['imageId'])->on('image')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('event_gallery', function (Blueprint $table) {
            $table->dropForeign('event_gallery_ibfk_1');
            $table->dropForeign('event_gallery_ibfk_2');
        });
    }
}
