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
            $table->string('booking_code')->default('SYSTIPS');
            $table->unsignedInteger('id_airline')->default(1);
            $table->unsignedInteger('id_origin_airport')->default(1);
            $table->unsignedInteger('id_destination_airport')->default(1);
            $table->dateTime('depature')->default('2018-01-01');
//            $table->dateTime('arrival');
            $table->string('flight_code')->default('SYSTIPS');
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
