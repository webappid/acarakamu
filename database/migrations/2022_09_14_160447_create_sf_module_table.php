<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSfModuleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sf_module', function (Blueprint $table) {
            $table->integer('moduleId', true);
            $table->string('moduleCode', 100)->unique('modulCode');
            $table->string('moduleName', 50);
            $table->string('fileName', 50)->default('');
            $table->string('typeFile', 15)->default('');
            $table->string('action', 15)->nullable();
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
        Schema::dropIfExists('sf_module');
    }
}
