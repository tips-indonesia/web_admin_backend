<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TambahTimerParams extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('cron_timer', function (Blueprint $table) {
            $table->integer('reminder_timer')->default(4);
            $table->integer('no_tipster_pickup_timer')->default(3);
            $table->integer('no_shipment_timer')->default(2);
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
        Schema::table('cron_timer', function (Blueprint $table) {
            $table->dropColumn('reminder_timer');
            $table->dropColumn('no_tipster_pickup_timer');
            $table->dropColumn('no_shipment_timer');
        });
    }
}
