<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\BankCardList;
use App\BankList;
use App\PaymentType;
use App\Transaction;
use App\EspayNotification;
use App\Shipment;
use App\MemberList;
use Storage;
use stdClass;

class PaymentController extends Controller
{
    function payment_method_all(){
        $payment_type = PaymentType::all();
        $payment_all = [];
        $isUseEspayPayment = false;

        foreach ($payment_type as $payment) {
            $isCashPayment = $payment->name == "Cash";
            $isUseEspayPayment |= $payment->name == "Espay";
            if($isCashPayment){
                $p = new stdClass();
                $p->bankCode = sprintf("%03d", ($payment->id + 900) % 1000);
                $p->productCode = 'TIPS-' . $payment->name;
                $p->productName = $payment->name;
                $p->isCash = true;
                array_push($payment_all, $p);
            }
        }

        if($isUseEspayPayment){
            foreach ($this->getInquiryMerchantInfo_BankList() as $p) {
                $p->isCash = false;
                array_push($payment_all, $p);
            }
        }

        return $payment_all;
    }

    //
    function list_type_payment() {


        $data = array(
            'err' => null,
            'result' => $this->payment_method_all()
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
        $data['payData']['bankCode'] = $request->bankCode;
        $data['payData']['bankProduct'] = $request->bankProduct;
        $data['payData']['callback_url'] = 'https://iris.tips.co.id/payment/status/get?payment_id=' . $request->payment_id;
        return view('payment.pay', $data);
    }

    public function startPaymentV2(Request $request){
        if(!$request->payment_id || !$request->bankCode || !$request->bankProduct || !$request->callback)
            return 'payment_id parameter can not be null';

        $transaction = Transaction::where('payment_id', $request->payment_id)->get();

        if(sizeof($transaction) == 0)
            return 'payment_id not found, make sure payment_id is correct';

        $data['payData'] = array();
        $data['payData']['payment_id'] = $request->payment_id;
        $data['payData']['bankCode'] = $request->bankCode;
        $data['payData']['bankProduct'] = $request->bankProduct;
        $data['payData']['callback_url'] = $request->callback;
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


        $data_to_go = "$code;$message;$order_id;$amount;$currency;$description;$datetime";
        Storage::disk('public')->append('inquiry.txt', "Response inquiry to ESPAY: " . $data_to_go);
        return $data_to_go;
        // return "$code;$message,$RECONCILE_CODE,$order_id,$datetime";
    }

    private function generateSGOEspayResponseNotification($data, $isOK){
        $code       = "1";
        $message    = "error unknown";
        $order_id   = "TIPS-1";
        $RECONCILE_CODE = $isOK ? "TIPSREC" . strtoupper("" . uniqid()) : "";
        date_default_timezone_set("Asia/Jakarta");
        $date       = date_create(now());
        $datetime   = date_format($date, 'd/m/Y H:i:s');

        if(array_key_exists("code", $data))
            $code = $data['code'];

        if(array_key_exists("message", $data))
            $message = $data['message'];

        if(array_key_exists("order_id", $data))
            $order_id = $data['order_id'];

        if(array_key_exists("datetime", $data))
            $datetime = $data['datetime'];

        return "$code,$message,$RECONCILE_CODE,$order_id,$datetime";
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
            $user_with_transaction = MemberList::find($transaction->user_id);

            if(!$user_with_transaction){
                $data_to_go = array(
                    "code"      => 95,
                    "message"   => "Pengguna dengan id transaksi " . $transaction_id . " tidak ditemukan",
                    "order_id"  => $transaction_id
                );
                $data = $this->generateSGOEspayTemplate($data_to_go);
            }else if(sizeof($transaction) == 0){
                $data_to_go = array(
                    "code"      => 97,
                    "message"   => "Transaksi " . $transaction_id . " tidak ditemukan",
                    "order_id"  => $transaction_id
                );
                $data = $this->generateSGOEspayTemplate($data_to_go);
            }else{
                $data_to_go = array(
                    "code"      => 0,
                    "message"   => "Success",
                    "order_id"  => $transaction_id,
                    "amount"    => number_format($transaction->amount, 2, ".", ""),
                    "description"   => "Pembayaran oleh : " . $user_with_transaction->first_name . " " . $user_with_transaction->last_name
                );
                $data = $this->generateSGOEspayTemplate($data_to_go);
            }
        }

        return response($data, 200);
    }

    // this is rio authority
    public function receivePaymentNotification(Request $request){
        // dd($request->all());
        Storage::disk('public')->append('payment.txt', json_encode($request->all()));
        try {
            EspayNotification::create($request->all());
        }
        catch (\Exception $e) {
            $data = $this->generateSGOEspayResponseNotification(array(
                "code"      => 98,
                "message"   => "Transaksi gagal #971\n" . $e->getMessage()
            ), false);
        }

        if(!$request->order_id){
            $data = $this->generateSGOEspayResponseNotification(array(
                "code"      => 98,
                "message"   => "Transaksi tidak ditemukan"
            ), false);
        }else{

            $transaction_id = $request->order_id;
            $transaction = Transaction::where('payment_id', $transaction_id)->first();
            $shipment = Shipment::where('payment_id', $transaction_id)->first();
            if($shipment)
                $shipment->create_transaction();

            if(sizeof($transaction) == 0){
                $data = $this->generateSGOEspayResponseNotification(array(
                    "code"      => 97,
                    "message"   => "Transaksi " . $transaction_id . " tidak ditemukan",
                    "order_id"  => $transaction_id
                ), false);
            }else{
                $data = $this->generateSGOEspayResponseNotification(array(
                    "code"      => 0,
                    "message"   => "Success",
                    "order_id"  => $transaction_id
                ), true);
            }
        }

        return response($data, 200);
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

        $data = array(
            'err' => null,
            'result' => $transaction
        );

        return response()->json($data, 200);
    }

    public function tesEspayNotif(Request $request){
        return response()->json(EspayNotification::create($request->all()), 200);
    }

    private function generateSignature($datetime, $order_id){
        $espay_signature = "71p5g0w012lDtiPSss";
        $uppercase = strtoupper("##$espay_signature##$datetime##$order_id##CHECKSTATUS##");
        $signature = hash('sha256', $uppercase);

        return $signature;
    }

    private function getStatusPayment($comm_code, $order_id){
        $uuid = "TIPS-SR-" . strtoupper("" . uniqid());
        
        date_default_timezone_set("Asia/Jakarta");
        $date       = date_create(now());
        $datetime   = date_format($date, 'd/m/Y H:i:s');

        $signature = $this->generateSignature($datetime, $order_id);
        $header = array(
            "Content-Type: application/x-www-form-urlencoded"
        );
        $context = stream_context_create(array(
            "http" => array(
                "method" => "POST",
                "header" => implode("\r\n", $header),
                "content" => "uuid=$uuid&rq_datetime=$datetime&comm_code=$comm_code&order_id=$order_id&signature=$signature",
            ),
        ));
        $response = file_get_contents('https://sandbox-api.espay.id/rest/merchant/status', false, $context);
        if (strpos($http_response_header[0], '200') === false) {
            return http_response_code(500);
        }else{
            return $response;
        }
    }

    public function getInquiryMerchantInfo_BankList(){
        
        date_default_timezone_set("Asia/Jakarta");
        $date       = date_create(now());
        $datetime   = date_format($date, 'd/m/Y H:i:s');
        $header = array(
            "Content-Type: application/x-www-form-urlencoded"
        );
        $context = stream_context_create(array(
            "http" => array(
                "method" => "POST",
                "header" => implode("\r\n", $header),
                "content" => "key=d1df1e4dc0075d52b721a9c2a67598ee",
            ),
        ));
        $response = file_get_contents('https://sandbox-api.espay.id/rest/merchant/merchantinfo', false, $context);
        if (strpos($http_response_header[0], '200') === false) {
            return [];
        }else{
            $php_obj_response = json_decode($response);
            if($php_obj_response->error_code != "0000")
                return [];

            return $php_obj_response->data;
        }
    }

    public function checkPaymentStatus(Request $request){
        if(!$request->payment_id)
            return 'payment_id parameter can not be null';

        $transaction = Transaction::where('payment_id', $request->payment_id)->get();

        if(sizeof($transaction) == 0)
            return 'payment_id not found, make sure payment_id is correct';

        return response($this->getStatusPayment("SGWTIPS", $request->payment_id), 200);
    }

    public function checkIfPaymentHasIssued(Request $req){
        $pid = $req->payment_id;
        $existing = EspayNotification::where('order_id', $pid)->first();
        return redirect('tips://' . ($existing ? 'berhasil' : 'gagal'));
    }
}
