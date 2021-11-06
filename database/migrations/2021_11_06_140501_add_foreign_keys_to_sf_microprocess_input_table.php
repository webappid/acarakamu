<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToSfMicroprocessInputTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sf_microprocess_input', function (Blueprint $table) {
            $table->foreign(['microprocessInputParamId'], 'sf_microprocess_input_ibfk_1')->references(['paramId'])->on('sf_microprocess_ref_param')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['microprocessInputProcessId'], 'sf_microprocess_input_ibfk_2')->references(['processId'])->on('sf_microprocess_ref_process')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sf_microprocess_input', function (Blueprint $table) {
            $table->dropForeign('sf_microprocess_input_ibfk_1');
            $table->dropForeign('sf_microprocess_input_ibfk_2');
        });
    }
}
