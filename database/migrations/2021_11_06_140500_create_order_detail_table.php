<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_detail', function (Blueprint $table) {
            $table->bigInteger('orderDetailId', true);
            $table->bigInteger('orderDetailOrderId')->index('orderDetailOrderId');
            $table->bigInteger('orderDetailEventId')->index('orderDetailEventId');
            $table->smallInteger('orderDetailQty')->default(1);
            $table->decimal('orderDetailEventCost', 10, 0)->default(0);
            $table->timestamp('orderDetailDateChange')->useCurrentOnUpdate()->useCurrent();
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
        Schema::dropIfExists('order_detail');
    }
}
