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
            $table->boolean('is_online')->default(true);
            $table->date('transaction_date');
            $table->unsignedInteger('id_office')->nullable();
            $table->unsignedInteger('id_slot')->nullable();
            $table->unsignedInteger('id_origin_city');
            $table->unsignedInteger('id_destination_city');
            $table->boolean('is_first_class');
            $table->unsignedInteger('id_shipper');
            $table->string('shipper_name');
            $table->string('shipper_address');
            $table->string('shipper_mobile_phone');
            $table->decimal('shipper_latitude');
            $table->decimal('shipper_longitude');
            $table->string('consignee_name');
            $table->string('consignee_address');
            $table->string('consignee_phone_no');
            $table->string('consignee_mobile_phone');
            $table->enum('dispatch_type', ['D', 'P'])->default('P');
            $table->boolean('is_online_payment');
            $table->unsignedInteger('id_payment_type');
            $table->string('shipment_contents');
            $table->unsignedInteger('estimate_goods_value');
            $table->unsignedInteger('estimate_weight');
            $table->unsignedInteger('flight_cost');
            $table->unsignedInteger('insurance_cost');
            $table->boolean('is_add_insurance');
            $table->unsignedInteger('add_insurance_cost');
            $table->string('add_notes')->nullable();
            $table->unsignedInteger('id_bank')->nullable();
            $table->unsignedInteger('bank_card_type')->nullable();
            $table->unsignedInteger('card_no')->nullable();
            $table->date('card_expired_date')->nullable();
            $table->unsignedInteger('card_security_code')->nullable();
//            $table->unsignedInteger('created_by');
            $table->unsignedInteger('id_shipment_status')->default(1);
            $table->date('shipment_status_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->time('shipment_status_time')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->unsignedInteger('id_packaging')->nullable();
            $table->date('packaging_date')->nullable();
            $table->time('packaging_time')->nullable();
            $table->string('received_by')->nullable();
            $table->timestamp('received_time')->nullable();
            $table->string('received_image')->nullable();

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
