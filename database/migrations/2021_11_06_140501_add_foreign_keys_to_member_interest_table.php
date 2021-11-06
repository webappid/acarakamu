<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToMemberInterestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('member_interest', function (Blueprint $table) {
            $table->foreign(['memberInterestCategoryId'], 'member_interest_ibfk_1')->references(['categoryId'])->on('category_ref')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['memberIntersetMemberId'], 'member_interest_ibfk_2')->references(['memberId'])->on('member')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('member_interest', function (Blueprint $table) {
            $table->dropForeign('member_interest_ibfk_1');
            $table->dropForeign('member_interest_ibfk_2');
        });
    }
}
