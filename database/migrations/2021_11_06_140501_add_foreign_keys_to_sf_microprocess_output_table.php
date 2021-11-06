<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToSfMicroprocessOutputTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sf_microprocess_output', function (Blueprint $table) {
            $table->foreign(['microprocessOutputMicroprocessId'], 'sf_microprocess_output_ibfk_1')->references(['microprocessId'])->on('sf_microprocess')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['microprocessOutputParamId'], 'sf_microprocess_output_ibfk_2')->references(['paramId'])->on('sf_microprocess_ref_param')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sf_microprocess_output', function (Blueprint $table) {
            $table->dropForeign('sf_microprocess_output_ibfk_1');
            $table->dropForeign('sf_microprocess_output_ibfk_2');
        });
    }
}
