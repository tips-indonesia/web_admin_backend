<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\BankCardList;
use App\BankList;

class PaymentController extends Controller
{
    //
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
}
