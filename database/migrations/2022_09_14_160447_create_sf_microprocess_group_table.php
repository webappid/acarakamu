<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSfMicroprocessGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sf_microprocess_group', function (Blueprint $table) {
            $table->bigInteger('microprocessMicroprocessId')->index('microserviceMicroserviceId');
            $table->integer('microprocessGroupId')->index('microserviceGroupId');
            $table->timestamps();

            $table->unique(['microprocessMicroprocessId', 'microprocessGroupId'], 'key');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sf_microprocess_group');
    }
}
