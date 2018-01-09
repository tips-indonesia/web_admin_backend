<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfficeListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('office_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('id_office_type');
            $table->text('address');
            $table->unsignedInteger('id_city');
            $table->unsignedInteger('id_province');
            $table->unsignedInteger('id_subdistrict');
            $table->unsignedInteger('id_office_counter')->nullable();
            $table->unsignedInteger('id_office_pc')->nullable();
            $table->unsignedInteger('id_airport')->nullable();
            $table->string('phone_no');
            $table->string('fax_no');
            $table->string('email_address');
            $table->string('contact_person_name');
            $table->decimal('latitude', 12, 7);
            $table->decimal('longitude', 12, 7);
            $table->boolean('status');
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
        Schema::dropIfExists('office_lists');
    }
}
