<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlotListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slot_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slot_id');
            $table->date('slot_date');
            $table->time('slot_time');
            $table->unsignedInteger('id_member');
            $table->unsignedInteger('id_flight_booking');
            $table->unsignedInteger('id_airline');
            $table->unsignedInteger('id_origin_airport');
            $table->unsignedInteger('id_destination_airport');
            $table->time('departure_time');
            $table->date('departure_date');
            $table->date('arrival_date');
            $table->time('arrival_time');
            $table->unsignedInteger('baggage_space');
            $table->unsignedInteger('sold_baggage_space');
            $table->unsignedInteger('sold_baggage_space_kg');
            $table->unsignedInteger('slot_price_kg');
            $table->string('status');
            $table->unsignedInteger('created_by');
            
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
        Schema::dropIfExists('slot_lists');
    }
}
