<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSfUserGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sf_user_group', function (Blueprint $table) {
            $table->bigInteger('userGroupUserId');
            $table->integer('userGroupGroupId')->index('userGroupGroupId');
            $table->timestamps();

            $table->primary(['userGroupUserId', 'userGroupGroupId']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sf_user_group');
    }
}
