<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event', function (Blueprint $table) {
            $table->bigInteger('eventId', true);
            $table->string('eventTitle', 50)->default('');
            $table->bigInteger('eventCoverImageId')->nullable()->index('eventCoverImageId');
            $table->text('eventDescription')->nullable();
            $table->integer('eventCityId')->index('eventCityId');
            $table->text('eventAlamatDetil')->nullable();
            $table->integer('eventCategoryId')->index('eventCategoryId');
            $table->decimal('eventPrice', 10, 0)->default(0);
            $table->text('eventInfo')->nullable();
            $table->smallInteger('eventStatusId')->default(1)->index('eventStatusId');
            $table->dateTime('eventDateTimeStart');
            $table->dateTime('eventDateTimeEnd');
            $table->timestamp('eventDateChange')->useCurrentOnUpdate()->useCurrent();
            $table->integer('eventQuota')->default(0);
            $table->integer('eventQuotaSisa')->default(0);
            $table->tinyInteger('eventGMT')->default(7);
            $table->bigInteger('eventOwnerUserId')->index('eventOwnerUserId');
            $table->bigInteger('eventUserId')->index('eventUserId');
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
        Schema::dropIfExists('event');
    }
}
