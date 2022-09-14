<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToSfMicroprocessRefProcessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sf_microprocess_ref_process', function (Blueprint $table) {
            $table->foreign(['processResultParamId'], 'sf_microprocess_ref_process_ibfk_1')->references(['paramId'])->on('sf_microprocess_ref_param')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sf_microprocess_ref_process', function (Blueprint $table) {
            $table->dropForeign('sf_microprocess_ref_process_ibfk_1');
        });
    }
}
