<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSfLabelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sf_label', function (Blueprint $table) {
            $table->integer('labelId', true);
            $table->integer('languageId')->nullable()->index('FK_label_language');
            $table->integer('modulId')->nullable();
            $table->string('labelName', 20)->nullable();
            $table->text('labelValue')->nullable();
            $table->integer('userId')->nullable()->index('FK_label_user');
            $table->dateTime('dateInsert')->nullable();
            $table->dateTime('dateChange')->nullable();
            $table->enum('publish', ['Yes', 'No'])->nullable()->default('Yes');
            $table->enum('status', ['Yes', 'No'])->nullable()->default('Yes');
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
        Schema::dropIfExists('sf_label');
    }
}
