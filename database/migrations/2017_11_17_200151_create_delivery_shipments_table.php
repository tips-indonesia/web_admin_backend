<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveryShipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_shipments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('delivery_id')->nullable();
            $table->date('delivery_date');
            $table->time('delivery_time')->default();
            $table->unsignedInteger('id_origin_office')->nullable();
            $table->unsignedInteger('id_destination_office')->nullable();
            $table->unsignedInteger('created_by');
            $table->boolean('is_posted');
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
        Schema::dropIfExists('delivery_shipments');
    }
}
