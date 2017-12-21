<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\BankCardList;
use App\BankList;
use App\PaymentType;
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
}
