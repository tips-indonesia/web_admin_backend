<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePriceListDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_list_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_airline');
            $table->unsignedInteger('id_airport_origin');
            $table->unsignedInteger('id_airport_destination');
            $table->unsignedInteger('id_goods_category');
            $table->decimal('tipster_price_per_kg', 18, 2);
            $table->decimal('freigh_price_per_kg', 18, 2);
            $table->decimal('packaging_price_per_kg', 18, 2);
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
        Schema::dropIfExists('price_list_details');
    }
}
