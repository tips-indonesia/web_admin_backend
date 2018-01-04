<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\HelpTipster;

class HelpTipsterController extends Controller
{
    //
    function index() {
        $help_tipster = HelpTipster::all();

        $data = array(
            'err' => null,
            'result' => $help_tipster
        );

        return response()->json($data, 200);
    }
}
