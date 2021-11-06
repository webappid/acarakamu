<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSfMicroprocessOutputTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sf_microprocess_output', function (Blueprint $table) {
            $table->bigInteger('microprocessOutputMicroprocessId')->nullable()->index('microserviceResultMicroserviceId');
            $table->bigInteger('microprocessOutputParamId')->nullable()->index('microserviceResultParamId');
            $table->enum('microprocessOutputAllowNull', ['yes', 'no'])->nullable();
            $table->timestamps();

            $table->unique(['microprocessOutputMicroprocessId', 'microprocessOutputParamId'], 'key');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sf_microprocess_output');
    }
}
