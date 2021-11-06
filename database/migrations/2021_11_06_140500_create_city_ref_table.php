<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCityRefTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('city_ref', function (Blueprint $table) {
            $table->integer('cityId', true);
            $table->integer('cityProvincesRefId')->index('cityProvincesRefId');
            $table->string('cityNama', 50)->default('');
            $table->enum('cityStatusAktif', ['true', 'false'])->default('true');
            $table->timestamp('cityDateChange')->useCurrentOnUpdate()->useCurrent();
            $table->bigInteger('cityUserId')->index('cityUserId');
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
        Schema::dropIfExists('city_ref');
    }
}
