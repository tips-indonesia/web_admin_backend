<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlightBookingListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flight_booking_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('booking_code')->unique();
            $table->unsignedInteger('id_airline');
            $table->unsignedInteger('id_origin_airport');
            $table->unsignedInteger('id_destination_airport');
            $table->dateTime('depature');
            $table->dateTime('arrival');
            $table->string('flight_code');
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
        Schema::dropIfExists('flight_booking_lists');
    }
}
