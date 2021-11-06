<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_permissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('role_id')->nullable()->index('role_permissions_role_id_foreign');
            $table->unsignedInteger('permission_id')->nullable()->index('role_permissions_permission_id_foreign');
            $table->unsignedBigInteger('created_by')->nullable()->index('role_permissions_created_by_foreign');
            $table->unsignedBigInteger('updated_by')->nullable()->index('role_permissions_updated_by_foreign');
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
        Schema::dropIfExists('role_permissions');
    }
}
