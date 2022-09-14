<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSecurityLevelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('SecurityLevel', function (Blueprint $table) {
            $table->bigIncrements('Id');
            $table->string('Label');
            $table->enum('IsMMEM', ['true', 'false'])->default('true');
            $table->timestamps();

            $table->unique(['Id'], 'Id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('SecurityLevel');
    }
}
