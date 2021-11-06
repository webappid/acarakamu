<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->bigInteger('orderId', true);
            $table->string('orderNumber', 20)->default('');
            $table->smallInteger('orderOrderStatus')->index('orderOrderStatus');
            $table->bigInteger('orderMemberId')->index('orderMemberId');
            $table->smallInteger('orderQty')->default(1);
            $table->decimal('orderCost', 10, 0)->default(0);
            $table->timestamp('orderDateTimeLimit')->nullable();
            $table->timestamp('orderDateTimeChange')->nullable();
            $table->bigInteger('orderUserId');
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
        Schema::dropIfExists('order');
    }
}
