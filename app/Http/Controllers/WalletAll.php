<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Wallet;
use App\WalletTransaction;
use App\MemberList;

class WalletAll extends Controller
{

	public static function failed_transaction($obj){
		return $obj;
	}

	public static function success_transaction($obj){
		return $obj;
	}

	public static function is_pre_validate_transaction_ok($member_id, $type_of_transaction,
	$debit, $credit, $remarks){
		return true;
	}

	public static function create_transaction($member_id, $type_of_transaction,
	$debit, $credit, $remarks){

		// if data not complete then return error
		if(!WalletAll::is_pre_validate_transaction_ok($member_id, $type_of_transaction,
		$debit, $credit, $remarks)){
			return WalletAll::failed_transaction("transaction data not complete");
		}

		$instance = Wallet::create([
			'member_id' 	=> $member_id,
			'trans_date' 	=> \Carbon\Carbon::now(),
			'trans_id' 		=> $type_of_transaction,
			'debit' 		=> $debit,
			'credit' 		=> $credit,
			'remarks' 		=> $remarks,
		]);

		return WalletAll::success_transaction($instance);
	}

	public static function ANTAR_TRANSACTION($member_id, $debit, $credit, $remarks){
		return WalletAll::create_transaction($member_id, 1, $debit, $credit, $remarks);
	}

	public static function KIRIM_TRANSACTION($member_id, $debit, $credit, $remarks){
		return WalletAll::create_transaction($member_id, 2, $debit, $credit, $remarks);
	}

	public static function CASH_TRANSACTION($member_id, $debit, $credit, $remarks){
		return WalletAll::create_transaction($member_id, 3, $debit, $credit, $remarks);
	}

	public static function REFFERAL_TRANSACTION($member_id, $debit, $credit, $remarks){
		return WalletAll::create_transaction($member_id, 4, $debit, $credit, $remarks);
	}

	public static function REFFERED_TRANSACTION($member_id, $debit, $credit, $remarks){
		return WalletAll::create_transaction($member_id, 5, $debit, $credit, $remarks);
	}

	public static function REEDEM_TRANSACTION($member_id, $debit, $credit, $remarks){
		return WalletAll::create_transaction($member_id, 6, $debit, $credit, $remarks);
	}

	public function test_wallet(){
		return WalletAll::ANTAR_TRANSACTION(1, 1000, 0, null);
	}
}
