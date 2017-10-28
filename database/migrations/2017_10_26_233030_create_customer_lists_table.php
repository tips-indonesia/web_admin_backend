<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('customer_code');
            $table->string('name');
            $table->string('address');
            $table->unsignedInteger('country_code');
            $table->unsignedInteger('province_code');
            $table->unsignedInteger('city_code');
            $table->string('phone_no');
            $table->string('fax_no');
            $table->string('email_address');
            $table->boolean('status');
            $table->unsignedInteger('id_country');
            $table->unsignedInteger('id_province');
            $table->unsignedInteger('id_city');
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
        Schema::dropIfExists('customer_lists');
    }
}
