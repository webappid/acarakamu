<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryRefTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_ref', function (Blueprint $table) {
            $table->integer('categoryId', true);
            $table->string('categoryNama', 50)->default('');
            $table->bigInteger('categoryImageId')->nullable();
            $table->string('categoryIcon', 100)->default('');
            $table->enum('categoryStatusAktif', ['true', 'false'])->default('true');
            $table->timestamp('categoryDateChange')->useCurrentOnUpdate()->useCurrent();
            $table->integer('categoryOrderBy')->default(1);
            $table->bigInteger('categoryUserId')->index('categoryUserId');
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
        Schema::dropIfExists('category_ref');
    }
}
