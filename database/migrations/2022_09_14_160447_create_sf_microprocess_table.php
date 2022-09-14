<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSfMicroprocessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sf_microprocess', function (Blueprint $table) {
            $table->bigInteger('microprocessId', true);
            $table->string('microprocessCode', 50)->default('')->unique('microprocessCode');
            $table->string('microprocessDesc', 200)->default('');
            $table->enum('microprocessAccess', ['All', 'Excluesive'])->default('All');
            $table->enum('microprocessMethod', ['open', 'execute'])->default('open');
            $table->string('microprocessCustomeSuccessCode', 5)->nullable();
            $table->text('microprocessCustomeSuccessMessage')->nullable();
            $table->enum('microprocessReturn', ['json', 'html'])->default('json');
            $table->enum('microprocessStatus', ['sanbox', 'live'])->default('sanbox');
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
        Schema::dropIfExists('sf_microprocess');
    }
}
