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

    private function generateSGOEspayTemplate($data){
        $code       = "1";
        $message    = "error unknown";
        $order_id   = "TIPS-1";
        $amount     = 0;
        $currency   = "IDR";
        $description = "there is an error on TIPS transaction process";
        date_default_timezone_set("Asia/Jakarta");
        $date       = date_create(now());
        $datetime   = date_format($date, 'd/m/Y H:i:s');

        if(array_key_exists("code", $data))
            $code = $data['code'];

        if(array_key_exists("message", $data))
            $message = $data['message'];

        if(array_key_exists("order_id", $data))
            $order_id = $data['order_id'];

        if(array_key_exists("amount", $data))
            $amount = $data['amount'];

        if(array_key_exists("currency", $data))
            $currency = $data['currency'];

        if(array_key_exists("description", $data))
            $description = $data['description'];

        if(array_key_exists("datetime", $data))
            $datetime = $data['datetime'];

        return "$code;$message;$order_id;$amount;$currency;$description;$datetime";
    }

    // this is rio authority
    public function receiveInquiry(Request $request){
        // dd($request->all());
        Storage::disk('public')->append('inquiry.txt', json_encode($request->all()));

        if(!$request->order_id){
            $data = $this->generateSGOEspayTemplate(array(
                "code"      => 98,
                "message"   => "Transaksi tidak ditemukan"
            ));
        }else{

            $transaction_id = $request->order_id;
            $transaction = Transaction::where('payment_id', $transaction_id)->first();

            if(sizeof($transaction) == 0){
                $data = $this->generateSGOEspayTemplate(array(
                    "code"      => 97,
                    "message"   => "Transaksi " . $transaction_id . " tidak ditemukan",
                    "order_id"  => $transaction_id
                ));
            }else{
                $data = $this->generateSGOEspayTemplate(array(
                    "code"      => 0,
                    "message"   => "Success",
                    "order_id"  => $transaction_id,
                    "amount"    => $transaction->amount,
                    "description"   => "Pembayaran oleh member id: " . $transaction->user_id
                ));
            }
        }

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

        if(!$request->user_id || !$request->amount){
            $data = array(
                'err' => "user id atau jumlah/amount tidak boleh kosong",
                'result' => null
            );
            return response()->json($data, 200);
        }


        $transaction = Transaction::create(array(
            "payment_id" => $id,
            "user_id" => $request->user_id,
            "amount" => $request->amount
        ));

        return response()->json($transaction, 200);
    }
}
