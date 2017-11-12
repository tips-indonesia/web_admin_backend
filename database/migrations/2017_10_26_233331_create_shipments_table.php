<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('shipment_id');
            $table->boolean('is_online');
            $table->date('transaction_date');
            $table->unsignedInteger('id_office');
            $table->unsignedInteger('id_slot');
            $table->unsignedInteger('id_origin_city');
            $table->unsignedInteger('id_destination_city');
            $table->boolean('is_first_class');
            $table->unsignedInteger('id_shipper');
            $table->string('shipper_name');
            $table->string('shipper_address');
            $table->string('shipper_mobile_phone');
            $table->string('shipper_email_address');
            $table->decimal('shipper_latitude');
            $table->decimal('shipper_longitude');
            $table->string('consignee_name');
            $table->string('consignee_address');
            $table->string('consignee_phone_no');
            $table->string('consignee_mobile_phone');
            $table->string('consignee_email_address');
            $table->enum('dispatch_type', ['D', 'P']);
            $table->boolean('is_online_payment');
            $table->unsignedInteger('id_payment_type');
            $table->string('shipment_contents');
            $table->unsignedInteger('estimate_goods_value');
            $table->unsignedInteger('estimate_weight');
            $table->unsignedInteger('flight_cost');
            $table->unsignedInteger('insurance_cost');
            $table->boolean('is_add_insurance');
            $table->decimal('add_insurance_cost');
            $table->string('add_notes');
            $table->unsignedInteger('id_bank');
            $table->unsignedInteger('bank_card_type');
            $table->unsignedInteger('card_no');
            $table->date('card_expired_date');
            $table->unsignedInteger('card_security_code');
            $table->unsignedInteger('created_by');
            $table->unsignedInteger('created_date');
            $table->unsignedInteger('created_time');
            $table->unsignedInteger('id_shipment_status');
            $table->date('shipment_status_date');
            $table->time('shipment_status_time');
            $table->unsignedInteger('id_packaging');
            $table->date('packaging_date');
            $table->time('packaging_time');
            $table->unsignedInteger('received_by');
            $table->unsignedInteger('received_date');
            $table->unsignedInteger('received_time');
            $table->binary('received_image');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipments');
    }
}
