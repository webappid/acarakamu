<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToOrderDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_detail', function (Blueprint $table) {
            $table->foreign(['orderDetailOrderId'], 'order_detail_ibfk_1')->references(['orderId'])->on('order')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['orderDetailEventId'], 'order_detail_ibfk_2')->references(['eventId'])->on('event')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_detail', function (Blueprint $table) {
            $table->dropForeign('order_detail_ibfk_1');
            $table->dropForeign('order_detail_ibfk_2');
        });
    }
}
