<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Wallet;
use App\WalletTransaction;
use App\MemberList;
use App\Redeem;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;

class WalletAll extends Controller
{
	public function getAllPromo(){
		$promos = Redeem::all();

		$promos_out = [];
		foreach ($promos as $promo) {
			$start_date_promo = new Carbon($promo->start_date);
			$end_date_promo = new Carbon($promo->end_date);
			if(Carbon::now(+7)->between($start_date_promo, $end_date_promo)){
				$promo->file_name = URL::to('storage/redeem/' . $promo->file_name);
	            array_push($promos_out, $promo);
			}
		}

        $data = array(
            'err' => null,
            'result' => [
            	'promos' => $promos_out
            ]
        );

        return response()->json($data, 200);
	}

	// -------------

	public static function failed_transaction($obj){
		return $obj;
	}

	public static function success_transaction($obj){
		return $obj;
	}

	public static function getWalletAmount($id){
		$_ms = Wallet::where('member_id', $id)->get();
		$_deb = 0;
		$_cre = 0;

		if($_ms)
			foreach ($_ms as $_m) {
				$_deb += $_m->debit;
				$_cre += $_m->credit;
			}

		return $_deb - $_cre;
	}

	public static function is_pre_validate_transaction_ok($member_id, $type_of_transaction,
	$debit, $credit, $remarks){
		return true;
	}

	public static function is_pre_validate_update_transaction_ok($member_id, $type_of_transaction,
	$debit, $credit){
		return true;
	}

	public static function is_pre_validate_delete_transaction_ok($member_id, $type_of_transaction, $remarks){
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

	public static function update_transaction($remarks, $member_id, $type_of_transaction,
	$debit, $credit){

		// if data not complete then return error
		if(!WalletAll::is_pre_validate_update_transaction_ok($member_id, $type_of_transaction,
		$debit, $credit)){
			return WalletAll::failed_transaction("transaction data not complete");
		}

		$instance = Wallet::where('trans_id', $type_of_transaction)
					->where('member_id', $member_id)
					->where('remarks', $remarks)
					->first();

		if(!$instance){
			return WalletAll::failed_transaction("transaction not found");
		}

		$instance->debit = $debit;
		$instance->credit = $credit;
		$instance->save();

		return WalletAll::success_transaction($instance);
	}

	public static function delete_transaction($remarks, $member_id, $type_of_transaction){

		// if data not complete then return error
		if(!WalletAll::is_pre_validate_delete_transaction_ok($member_id, $type_of_transaction,
		$remarks)){
			return WalletAll::failed_transaction("transaction data not complete");
		}

		$instance = Wallet::where('trans_id', $type_of_transaction)
					->where('member_id', $member_id)
					->where('remarks', $remarks)
					->first();

		if(!$instance){
			return WalletAll::failed_transaction("transaction not found");
		}
		$instance->delete();

		return WalletAll::success_transaction($instance);
	}

	public static function ANTAR_TRANSACTION($member_id, $debit, $credit, $remarks){
		return WalletAll::create_transaction($member_id, 1, $debit, $credit, $remarks);
	}

	public static function KIRIM_TRANSACTION($member_id, $debit, $credit, $remarks){
		return WalletAll::create_transaction($member_id, 2, $debit, $credit, $remarks);
	}

	public static function CASH_TRANSACTION($member_id, $debit, $credit, $remarks){
		$start_date_promo = new Carbon("2018-06-15");
		$end_date_promo = new Carbon("2018-07-22");
		if(Carbon::now()->between($start_date_promo, $end_date_promo)){
			return WalletAll::create_transaction($member_id, 3, $debit, 0, $remarks);
		}

		return WalletAll::create_transaction($member_id, 3, $debit, $credit, $remarks);
	}

	public static function REFFERAL_TRANSACTION($member_id, $debit, $credit, $remarks){
		return WalletAll::create_transaction($member_id, 4, $debit, $credit, $remarks);
	}

	public static function REFFERED_TRANSACTION($member_id, $debit, $credit, $remarks){
		return WalletAll::create_transaction($member_id, 5, $debit, $credit, $remarks);
	}

	public static function KIRIM_PAYMENT_TRANSACTION($member_id, $debit, $credit, $remarks){
		return WalletAll::create_transaction($member_id, 6, $debit, $credit, $remarks);
	}

	public static function UPDATE_KIRIM_PAYMENT_TRANSACTION($member_id, $debit, $credit, $remarks){
		$wtu = WalletAll::update_transaction($remarks, $member_id, 6, $debit, $credit);
	}

	public static function DELETE_KIRIM_PAYMENT_TRANSACTION($member_id, $remarks){
		$wtu = WalletAll::delete_transaction($remarks, $member_id, 6);
	}

	public static function REEDEM_TRANSACTION($member_id, $debit, $credit, $remarks){
		return WalletAll::create_transaction($member_id, 7, $debit, $credit, $remarks);
	}

	public function test_wallet(){
		return WalletAll::ANTAR_TRANSACTION(1, 1000, 0, null);
	}
}
