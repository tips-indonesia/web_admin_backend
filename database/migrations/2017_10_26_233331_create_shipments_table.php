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
            $table->unsignedInteger('id_shipper')->nullable();
            $table->string('id_device');
//            $table->string('shipper_name');
            $table->string('shipper_first_name');
            $table->string('shipper_last_name')->nullable();
            $table->unsignedInteger('id_shipper_districts');
            $table->string('shipper_districts');
            $table->unsignedInteger('id_shipper_city');
            $table->string('shipper_city');
            $table->unsignedInteger('id_shipper_province');
            $table->string('shipper_province');
            $table->string('shipper_address');
            $table->string('shipper_mobile_phone');
            $table->decimal('shipper_latitude');
            $table->decimal('shipper_longitude');
//            $table->string('consignee_name');
            $table->string('consignee_first_name');
            $table->string('consignee_last_name')->nullable();
            $table->unsignedInteger('id_consignee_districts');
            $table->string('consignee_districts');
            $table->unsignedInteger('id_consignee_city');
            $table->string('consignee_city');
            $table->unsignedInteger('id_consignee_province');
            $table->string('consignee_province');
            $table->string('consignee_address');
            $table->string('consignee_mobile_phone');
            $table->enum('dispatch_type', ['Dispatch to consignee', 'Pickup to consignee'])->default('Dispatch to consignee');
            $table->enum('goods_status', ['Pending', 'Received'])->default('Pending');
            $table->enum('registration_type', ['Offline', 'Online', 'Pickup'])->default('Pickup');
            $table->boolean('is_online_payment')->nullable();
            $table->unsignedInteger('id_payment_type');
            $table->string('shipment_contents');
            $table->unsignedInteger('estimate_goods_value');
            $table->unsignedInteger('estimate_weight');
            $table->unsignedInteger('flight_cost')->nullable();
            $table->unsignedInteger('insurance_cost');
            $table->boolean('is_add_insurance');
            $table->unsignedInteger('add_insurance_cost');
            $table->string('add_notes')->nullable();
            $table->unsignedInteger('id_bank')->nullable();
            $table->unsignedInteger('bank_card_type')->nullable();
            $table->unsignedInteger('card_no')->nullable();
            $table->date('card_expired_date')->nullable();
            $table->unsignedInteger('card_security_code')->nullable();
            $table->unsignedInteger('id_shipment_status')->default(1);
            $table->timestamp('shipment_status_update_timestamp')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->unsignedInteger('id_packaging')->nullable();
            $table->date('packaging_date')->nullable();
            $table->time('packaging_time')->nullable();
            $table->string('received_by')->nullable();
            $table->timestamp('received_time')->nullable();
            $table->string('received_image')->nullable();
            $table->boolean('is_posted')->default(false);
            $table->string('detail_status')->nullable();
            $table->boolean('is_delivery')->default(false);
            $table->boolean('is_take')->default(false);
            $table->enum('pickup_status', ['Pending', 'Done'])->default('Pending');
            $table->date('pickup_date')->nullable();
            $table->time('pickup_time')->nullable();
            $table->string('payment_id');
            $table->string('notes_address')->nullable();
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
        Schema::dropIfExists('shipments');
    }
}
