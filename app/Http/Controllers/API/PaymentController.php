<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use App\PaymentType;

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
}
