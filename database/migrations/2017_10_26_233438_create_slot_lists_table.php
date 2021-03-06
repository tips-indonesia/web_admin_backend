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
            $table->unsignedInteger('id_member');
            $table->unsignedInteger('id_wallet_transaction')->nullable();
            $table->string('booking_code');
            $table->string('first_name');
            $table->string('last_name');
            $table->enum('status_dispatch', ['Pending', 'Process', 'Complete', 'Canceled'])->default('Pending');
            $table->unsignedInteger('id_airline');
            $table->unsignedInteger('id_origin_airport');
            $table->unsignedInteger('id_destination_airport');
            $table->unsignedInteger('id_origin_city');
            $table->unsignedInteger('id_destination_city');
            $table->string('origin_city');
            $table->string('destination_city');
            $table->dateTime('depature');
//            $table->dateTime('arrival');
            $table->string('flight_code');
            $table->decimal('baggage_space');
            $table->decimal('sold_baggage_space')->default(0);
            $table->unsignedInteger('slot_price_kg');
            $table->integer('id_slot_status')->default(1);
            $table->string('photo_tag')->nullable();
            $table->string('detail_status')->nullable();
            $table->integer('status_bayar')->default(0);
            $table->softDeletes();
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
