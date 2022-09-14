<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSfGroupModuleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sf_group_module', function (Blueprint $table) {
            $table->integer('groupModId', true);
            $table->integer('groupId')->default(0)->index('groupId');
            $table->integer('moduleId')->default(0)->index('modulId');
            $table->string('accessId', 20)->nullable();
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
        Schema::dropIfExists('sf_group_module');
    }
}
