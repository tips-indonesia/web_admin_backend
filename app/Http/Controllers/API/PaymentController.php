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
        $bank_list = [];

        foreach ($bank_list_init as $bank) {
            $bank->card = BankCardList::where('id_bank', $bank->id)->get();
            array_push($bank_list, $bank);
        }

        $data = array(
            'err' => null,
            'result' => $bank_list
        );

        return response()->json($data, 200);
    }
}
