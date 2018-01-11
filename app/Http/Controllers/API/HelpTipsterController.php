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
        $final_help = [];

        foreach ($help_tipster as $help) {
            $help->description = explode('\n', $help->description);
            array_push($final_help, $help);
        }

        $data = array(
            'err' => null,
            'result' => $help_tipster
        );

        return response()->json($data, 200);
    }
}
