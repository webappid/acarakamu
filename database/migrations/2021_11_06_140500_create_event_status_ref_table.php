<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventStatusRefTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_status_ref', function (Blueprint $table) {
            $table->smallInteger('eventStatusId', true);
            $table->string('eventStatusNama', 50)->default('');
            $table->timestamp('eventStatusDateChange')->useCurrentOnUpdate()->useCurrent();
            $table->bigInteger('eventStatusUserId')->index('eventStatusUserId');
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
        Schema::dropIfExists('event_status_ref');
    }
}
