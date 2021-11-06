<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterIconAppMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $driver = Schema::connection($this->getConnection())->getConnection()->getDriverName();

        if ($driver != 'sqlite') {
            if (Schema::hasColumn('app_menus', 'icon')) {
                Schema::table('app_menus', function (Blueprint $table) {
                    $table->string('icon', 100)->change();
                });
            }
        }
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
            if (Schema::hasColumn('app_menus', 'icon')) {
                Schema::table('app_menus', function (Blueprint $table) {
                    $table->string('icon', 20)->change();
                });
            }
        }
    }
}
