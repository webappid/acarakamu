<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvincesRefTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provinces_ref', function (Blueprint $table) {
            $table->integer('provincesRefId', true);
            $table->string('provincesRefNama', 50);
            $table->enum('provincesRefStatusActive', ['true', 'false'])->default('false');
            $table->timestamp('provincesRefDateChange')->useCurrentOnUpdate()->useCurrent();
            $table->bigInteger('provincesRefUserId')->index('provincesRefUserId');
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
        Schema::dropIfExists('provinces_ref');
    }
}
