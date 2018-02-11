<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveryToArrivalProcessingCenterDetilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_to_arrival_processing_center_detil', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_delivery');
            $table->unsignedInteger('id_package');
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
        Schema::dropIfExists('delivery_to_arrival_processing_center_detil');
    }
}
