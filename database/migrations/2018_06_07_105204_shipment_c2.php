<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ShipmentC2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('shipments', function (Blueprint $table) {
            if(!Schema::hasColumn('shipments', 'shipper_postal_code')){
                $table->string('shipper_postal_code')->nullable();
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
        Schema::table('shipments', function (Blueprint $table) {
            if(Schema::hasColumn('shipments', 'shipper_postal_code')){
                $table->dropColumn('shipper_postal_code');
            }
        });
    }
}
