<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member', function (Blueprint $table) {
            $table->bigInteger('memberId', true);
            $table->bigInteger('memberUserId')->index('memberUserId');
            $table->string('memberFirstName', 50)->default('');
            $table->string('memberLastName', 50)->default('');
            $table->string('memberEmail', 50)->default('');
            $table->bigInteger('memberImageId')->nullable()->index('memberImageId');
            $table->string('memberNoTelp', 20)->default('');
            $table->timestamp('memberDateChange')->useCurrentOnUpdate()->useCurrent();
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
        Schema::dropIfExists('member');
    }
}
