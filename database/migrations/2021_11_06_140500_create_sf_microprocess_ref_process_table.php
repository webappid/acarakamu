<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSfMicroprocessRefProcessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sf_microprocess_ref_process', function (Blueprint $table) {
            $table->bigInteger('processId', true);
            $table->string('processCode', 50)->unique('processCode');
            $table->string('processDesc')->default('');
            $table->text('processProcess')->nullable();
            $table->enum('processMethod', ['open', 'execute'])->default('open');
            $table->bigInteger('processResultParamId')->nullable()->index('processResultParamId');
            $table->enum('processType', ['query', 'code', 'rest_get', 'rest_post', 'email', 'merge', 'template', 'stream'])->default('query');
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
        Schema::dropIfExists('sf_microprocess_ref_process');
    }
}
