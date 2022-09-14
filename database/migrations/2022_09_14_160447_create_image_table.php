<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image', function (Blueprint $table) {
            $table->bigInteger('imageId', true);
            $table->string('imageName')->default('');
            $table->string('imageDescription')->default('');
            $table->string('imageAlt', 50)->default('');
            $table->bigInteger('imageOwnerUserId')->index('imageOwnerUserId');
            $table->timestamp('imageDateChange')->useCurrentOnUpdate()->useCurrent();
            $table->bigInteger('imageUserId')->index('imageUserId');
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
        Schema::dropIfExists('image');
    }
}
