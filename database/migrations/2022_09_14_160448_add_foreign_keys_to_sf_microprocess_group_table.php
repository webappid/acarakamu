<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToSfMicroprocessGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sf_microprocess_group', function (Blueprint $table) {
            $table->foreign(['microprocessMicroprocessId'], 'sf_microprocess_group_ibfk_1')->references(['microprocessId'])->on('sf_microprocess')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['microprocessGroupId'], 'sf_microprocess_group_ibfk_2')->references(['groupId'])->on('sf_group')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sf_microprocess_group', function (Blueprint $table) {
            $table->dropForeign('sf_microprocess_group_ibfk_1');
            $table->dropForeign('sf_microprocess_group_ibfk_2');
        });
    }
}
