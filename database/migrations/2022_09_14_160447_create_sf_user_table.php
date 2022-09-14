<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSfUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sf_user', function (Blueprint $table) {
            $table->bigInteger('userId', true);
            $table->string('userName', 100)->unique('userName');
            $table->string('realName', 200)->nullable();
            $table->string('pwdUser', 100);
            $table->integer('groupId')->nullable()->index('groupId');
            $table->dateTime('lastLogin')->nullable();
            $table->enum('status', ['active', 'non'])->default('active');
            $table->string('loginKey')->default('');
            $table->string('activateKey', 50)->default('');
            $table->timestamp('dateTimeChange')->useCurrent();
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
        Schema::dropIfExists('sf_user');
    }
}
