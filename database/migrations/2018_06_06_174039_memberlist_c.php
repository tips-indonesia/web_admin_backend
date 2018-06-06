<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MemberlistC extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('member_lists', function (Blueprint $table) {
            $table->string('ref_code')->nullable();
            $table->string('register_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('member_lists', function (Blueprint $table) {
            $table->dropColumn('ref_code');
            $table->dropColumn('register_by');
        });
    }
}
