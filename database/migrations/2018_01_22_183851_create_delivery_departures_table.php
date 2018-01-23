<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveryDeparturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_departures', function (Blueprint $table) {
            $table->increments('id');
            $table->string('delivery_id')->nullable();
            $table->date('delivery_date');
            $table->time('delivery_time')->default();
            $table->unsignedInteger('created_by');
            $table->boolean('is_posted')->default(false);
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
        Schema::dropIfExists('delivery_departures');
    }
}
