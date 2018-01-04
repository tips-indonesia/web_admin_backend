<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\BankCardList;
use App\BankList;
use App\PaymentType;
use App\Transaction;
use Storage;

class PaymentController extends Controller
{
    //
    function list_type_payment() {
//        $bank_list_init = BankList::all();
//        $cards = [];
//
//        foreach ($bank_list_init as $bank) {
//            foreach (BankCardList::where('id_bank', $bank->id)->get() as $card) {
//                $card->name = $bank->name.' - '.$card->name;
//                array_push($cards, $card);
//            }
//
//        }

        $payment_type = PaymentType::all();

        $data = array(
            'err' => null,
            'result' => $payment_type
        );

        return response()->json($data, 200);
    }

    function bank_list() {
        $bank_list_init = BankList::all();
        $cards = [];
        foreach ($bank_list_init as $bank) {
            foreach (BankCardList::where('id_bank', $bank->id)->get() as $card) {
                $card->name = $bank->name.' - '.$card->name;
                array_push($cards, $card);
            }
        }
        $data = array(
            'err' => null,
            'result' => $cards
        );
        return response()->json($data, 200);
    }

    public function startPayment(Request $request){
        if(!$request->payment_id)
            return 'payment_id parameter can not be null';

        $transaction = Transaction::where('payment_id', $request->payment_id)->get();

        if(sizeof($transaction) == 0)
            return 'payment_id not found, make sure payment_id is correct';

        $data['payData'] = array();
        $data['payData']['payment_id'] = $request->payment_id;
        $data['payData']['callback_url'] = 'http://localhost';
        return view('payment.pay', $data);
    }

    // this is rio authority
    public function receiveInquiry(Request $request){
        // dd($request->all());
        Storage::disk('public')->append('inquiry.txt', json_encode($request->all()));
        $data = array(
            'err' => null,
            'result' => $request->all()
        );
        return response()->json($data, 200);
    }

    // this is rio authority
    public function receivePaymentNotification(Request $request){
        // dd($request->all());
        Storage::disk('public')->append('payment.txt', json_encode($request->all()));
        $data = array(
            'err' => null,
            'result' => $request->all()
        );
        return response()->json($data, 200);
    }

    public function createTransaction(Request $request){
        $id = "TIPS" . strtoupper("" . uniqid());
        $transaction = Transaction::create(array(
            "payment_id" => $id,
            "user_id" => $request->user_id,
            "amount" => $request->amount
        ));

        return response()->json($transaction, 200);
    }
}
