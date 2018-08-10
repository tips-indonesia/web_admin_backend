<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EspayNotification extends Model
{
    protected $guarded = array();
    protected static function boot() {
	    parent::boot();

	    static::saving(function($model) {
	        $savable = ['rq_uuid', 'rq_datetime', 'member_id', 'comm_code', 'order_id', 'sender_id', 'receiver_id', 'member_code', 'member_cust_id', 'member_cust_name', 'payment_remark', 'password', 'ccy', 'amount', 'debit_from', 'debit_from_name', 'credit_to', 'credit_to_name', 'product_code', 'product_value', 'message', 'status', 'token', 'payment_datetime', 'payment_ref', 'debit_from_bank', 'credit_to_bank', 'approval_code_full_bca', 'approval_code_installment_bca', 'signature', 'total_amount'];
	        if (count($savable) > 0) {
	            $model->attributes = array_intersect_key($model->attributes, array_flip($savable));
	        }
	    });
	}
}
