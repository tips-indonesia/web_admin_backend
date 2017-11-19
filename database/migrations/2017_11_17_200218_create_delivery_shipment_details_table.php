<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveryShipmentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_shipment_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_shipment');
            $table->unsignedInteger('id_delivery');
            $table->date('processing_center_received_date')->nullable();
            $table->time('processing_center_received_time')->nullable();
            $table->unsignedInteger('processing_center_received_by')->nullable();
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
        Schema::dropIfExists('delivery_shipment_details');
    }
}
