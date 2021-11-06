<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSfMicroprocessRefParamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sf_microprocess_ref_param', function (Blueprint $table) {
            $table->bigInteger('paramId', true);
            $table->string('paramName', 150)->unique('paramName');
            $table->enum('paramTypeData', ['string', 'integer', 'date', 'email', 'array', 'url', 'multiarray', 'single', 'file'])->default('string');
            $table->enum('paramAllowNull', ['yes', 'no'])->default('yes');
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
        Schema::dropIfExists('sf_microprocess_ref_param');
    }
}
