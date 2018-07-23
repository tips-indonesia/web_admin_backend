<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PerbaikanColumnEspayNotif extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('espay_notifications', function (Blueprint $table) {
            if(!Schema::hasColumn('espay_notifications', 'total_amount')){
                $table->unsignedDecimal('total_amount', 13, 2);
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('espay_notifications', function (Blueprint $table) {
            if(Schema::hasColumn('espay_notifications', 'total_amount')){
                $table->dropColumn('total_amount');
            }
        });
    }
}
