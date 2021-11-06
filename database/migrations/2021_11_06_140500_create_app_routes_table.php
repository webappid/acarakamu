<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_routes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique()->comment('route name');
            $table->string('uri', 100)->default('/');
            $table->string('method', 10)->default('GET');
            $table->enum('status', ['private', 'public'])->nullable()->default('public')->comment('Route status public or private. Default public');
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
        Schema::dropIfExists('app_routes');
    }
}
