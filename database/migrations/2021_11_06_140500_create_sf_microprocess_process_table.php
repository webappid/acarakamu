<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSfMicroprocessProcessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sf_microprocess_process', function (Blueprint $table) {
            $table->bigInteger('microprocessProcessId', true);
            $table->bigInteger('microprocessProcessMicroprocessId')->index('microserviceQueryMicroserviceId');
            $table->integer('microprocessProcessOrder')->default(1);
            $table->bigInteger('microprocessProcessProcessId')->nullable()->index('microserviceQueryQueryId');
            $table->enum('microprocessProcessNext', ['next', 'stop', 'jumpto'])->default('next');
            $table->bigInteger('microprocessProcessJumpProcess')->nullable();
            $table->enum('microprocessProcessJoin', ['inner', 'left', 'child', 'right', 'outer', 'leftouter', 'rightouter', 'right_child'])->nullable();
            $table->bigInteger('microprocessProcessLinkId')->nullable()->index('microprocessProcessLinkId');
            $table->bigInteger('microprocessProcessKeyId')->nullable()->index('microprocessProcessKeyId');
            $table->bigInteger('microprocessProcessForeignId')->nullable()->index('microprocessProcessForeignId');
            $table->enum('microprocessProcessEmpty', ['true', 'false'])->nullable();
            $table->string('microprocessProcessFalseCode', 5)->nullable();
            $table->text('microprocessProcessFalseMessage')->nullable();
            $table->string('microprocessProcessTrueCode', 5)->nullable();
            $table->text('microprocessProcessTrueMessage')->nullable();
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
        Schema::dropIfExists('sf_microprocess_process');
    }
}
