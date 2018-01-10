<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEspayNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('espay_notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('rq_uuid');
            $table->string('rq_datetime');
            $table->string('member_id')->nullable();
            $table->string('comm_code');
            $table->string('order_id');
            $table->string('sender_id')->nullable();
            $table->string('receiver_id')->nullable();
            $table->string('member_code')->nullable();
            $table->string('member_cust_id')->nullable();
            $table->string('member_cust_name')->nullable();
            $table->string('payment_remark')->nullable();
            $table->string('password')->nullable();
            $table->string('ccy');
            $table->unsignedDecimal('amount', 13, 2);
            $table->string('debit_from')->nullable();
            $table->string('debit_from_name')->nullable();
            $table->string('credit_to')->nullable();
            $table->string('credit_to_name')->nullable();
            $table->string('product_code');
            $table->string('product_value')->nullable();
            $table->string('message')->nullable();
            $table->string('status')->nullable();
            $table->string('token')->nullable();
            $table->string('payment_datetime');
            $table->string('payment_ref');
            $table->string('debit_from_bank');
            $table->string('credit_to_bank');
            $table->string('approval_code_full_bca')->nullable();
            $table->string('approval_code_installment_bca')->nullable();
            $table->string('signature');
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
        Schema::dropIfExists('espay_notifications');
    }
}
