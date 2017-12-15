<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Term;

class TermConditionsController extends Controller
{
    //
    function index(){
        $terms = Term::all();
        $data = array(
            'err' => null,
            'result' => $terms
        );

        return response()->json($data, 200);
    }
}
