<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAddOrderAppMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('app_menus', function (Blueprint $table) {
            $table->integer('menu_order')
                ->nullable(false)
                ->default(1)
                ->after('icon');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $driver = Schema::connection($this->getConnection())->getConnection()->getDriverName();

        if ($driver != 'sqlite') {
            Schema::table('app_menus', function (Blueprint $table) {
                $table->dropColumn(['menu_order']);
            });
        }
    }
}
