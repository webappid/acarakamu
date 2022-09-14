<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order', function (Blueprint $table) {
            $table->foreign(['orderMemberId'], 'order_ibfk_1')->references(['memberId'])->on('member')->onUpdate('CASCADE');
            $table->foreign(['orderOrderStatus'], 'order_ibfk_2')->references(['orderStatusId'])->on('order_status')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order', function (Blueprint $table) {
            $table->dropForeign('order_ibfk_1');
            $table->dropForeign('order_ibfk_2');
        });
    }
}
