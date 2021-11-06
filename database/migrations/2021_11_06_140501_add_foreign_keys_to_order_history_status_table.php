<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToOrderHistoryStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_history_status', function (Blueprint $table) {
            $table->foreign(['orderHistoryStatusOrderId'], 'order_history_status_ibfk_1')->references(['orderId'])->on('order')->onUpdate('CASCADE');
            $table->foreign(['orderHistoryStatusStatusId'], 'order_history_status_ibfk_2')->references(['orderStatusId'])->on('order_status')->onUpdate('CASCADE');
            $table->foreign(['orderHistoryStatusUserId'], 'order_history_status_ibfk_3')->references(['userId'])->on('sf_user')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_history_status', function (Blueprint $table) {
            $table->dropForeign('order_history_status_ibfk_1');
            $table->dropForeign('order_history_status_ibfk_2');
            $table->dropForeign('order_history_status_ibfk_3');
        });
    }
}
