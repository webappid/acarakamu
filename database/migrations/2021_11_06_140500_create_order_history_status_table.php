<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderHistoryStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_history_status', function (Blueprint $table) {
            $table->bigInteger('orderHistoryStatusId', true)->comment('table untuk menyimpan history status');
            $table->bigInteger('orderHistoryStatusOrderId')->index('orderHistoryStatusOrderId')->comment('order id');
            $table->text('orderHistoryStatusDesc')->nullable()->comment('keterangan perubahan');
            $table->smallInteger('orderHistoryStatusStatusId')->index('orderHistoryStatusStatusId')->comment('status perubahan');
            $table->bigInteger('orderHistoryStatusUserId')->index('orderHistoryStatusUserId')->comment('User Yang Melakukan perubahan');
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
        Schema::dropIfExists('order_history_status');
    }
}
