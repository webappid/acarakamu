<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToSfGroupModuleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sf_group_module', function (Blueprint $table) {
            $table->foreign(['groupId'], 'sf_group_module_ibfk_1')->references(['groupId'])->on('sf_group');
            $table->foreign(['moduleId'], 'sf_group_module_ibfk_2')->references(['moduleId'])->on('sf_module');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sf_group_module', function (Blueprint $table) {
            $table->dropForeign('sf_group_module_ibfk_1');
            $table->dropForeign('sf_group_module_ibfk_2');
        });
    }
}
