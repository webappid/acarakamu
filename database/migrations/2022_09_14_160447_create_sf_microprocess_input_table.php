<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSfMicroprocessInputTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sf_microprocess_input', function (Blueprint $table) {
            $table->bigInteger('microprocessInputId', true);
            $table->bigInteger('microprocessInputProcessId')->index('microprocessInputProcessId');
            $table->bigInteger('microprocessInputParamId')->index('microserviceParamParamId');
            $table->integer('microprocessInputParamOrder')->default(1);
            $table->bigInteger('microprocessInputParamParentId')->default(0);
            $table->enum('microprocessInputAllowNull', ['yes', 'no'])->nullable();
            $table->enum('microprocessInputModel', ['equal', 'like_pref', 'like_suf', 'like_both'])->default('equal');
            $table->timestamps();

            $table->unique(['microprocessInputProcessId', 'microprocessInputParamId', 'microprocessInputParamOrder', 'microprocessInputParamParentId'], 'key');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sf_microprocess_input');
    }
}
