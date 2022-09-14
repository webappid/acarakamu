<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToSfMicroprocessProcessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sf_microprocess_process', function (Blueprint $table) {
            $table->foreign(['microprocessProcessProcessId'], 'sf_microprocess_process_ibfk_1')->references(['processId'])->on('sf_microprocess_ref_process')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['microprocessProcessMicroprocessId'], 'sf_microprocess_process_ibfk_2')->references(['microprocessId'])->on('sf_microprocess')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['microprocessProcessLinkId'], 'sf_microprocess_process_ibfk_3')->references(['processId'])->on('sf_microprocess_ref_process')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['microprocessProcessKeyId'], 'sf_microprocess_process_ibfk_4')->references(['paramId'])->on('sf_microprocess_ref_param')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['microprocessProcessForeignId'], 'sf_microprocess_process_ibfk_5')->references(['paramId'])->on('sf_microprocess_ref_param')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sf_microprocess_process', function (Blueprint $table) {
            $table->dropForeign('sf_microprocess_process_ibfk_1');
            $table->dropForeign('sf_microprocess_process_ibfk_2');
            $table->dropForeign('sf_microprocess_process_ibfk_3');
            $table->dropForeign('sf_microprocess_process_ibfk_4');
            $table->dropForeign('sf_microprocess_process_ibfk_5');
        });
    }
}
