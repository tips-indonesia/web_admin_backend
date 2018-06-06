<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ShipmentC extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('shipments', function (Blueprint $table) {
            $table->string('pickup_signature')->nullable();
            $table->unsignedInteger('id_wallet_transaction')->nullable();

            // Consignee Address
            $table->unsignedInteger('id_consignee_districts')->nullable();
            $table->string('consignee_districts')->nullable();
            $table->unsignedInteger('id_consignee_city')->nullable();
            $table->string('consignee_city')->nullable();
            $table->unsignedInteger('id_consignee_province')->nullable();
            $table->string('consignee_province')->nullable();
            $table->string('consignee_postal_code')->nullable();
            $table->decimal('consignee_latitude', 15, 7)->nullable();
            $table->decimal('consignee_longitude', 15, 7)->nullable();

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shipments', function (Blueprint $table) {
            $table->dropColumn('pickup_signature');
            $table->dropColumn('id_wallet_transaction');

            // Consignee Address
            $table->dropColumn('id_consignee_districts');
            $table->dropColumn('consignee_districts');
            $table->dropColumn('id_consignee_city');
            $table->dropColumn('consignee_city');
            $table->dropColumn('id_consignee_province');
            $table->dropColumn('consignee_province');
            $table->dropColumn('consignee_postal_code');
            $table->dropColumn('consignee_latitude', 15, 7);
            $table->dropColumn('consignee_longitude', 15, 7);

        });
    }
}
