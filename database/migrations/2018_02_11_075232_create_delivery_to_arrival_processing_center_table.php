<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveryToArrivalProcessingCenterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_to_arrival_processing_center', function (Blueprint $table) {
            $table->increments('id');
            $table->string('delivery_id', 50)->nullable($value = true);
            $table->date('delivery_date');
            $table->unsignedInteger('created_by');
            $table->time('delivery_time');
            $table->unsignedInteger('id_kantor_asal');
            $table->unsignedInteger('id_kantor_tujuan');
            $table->unsignedInteger('is_submit');
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
        Schema::dropIfExists('delivery_to_arrival_processing_center');
    }
}
