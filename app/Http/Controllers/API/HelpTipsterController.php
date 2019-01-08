<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\HelpTipster;
use App\DangerousGoodInfo;

class HelpTipsterController extends Controller
{
    //
    function index(Request $request) {
        $lang = $request->header('lang') ? $request->header('lang') : null;
        if (!$lang) {
            $lang = isset($_GET['lang']) ? $_GET['lang'] : null;
        }
        if (!$lang) {
            return response()->json([
                    'err' => [
                        'code' => 400,
                        'message' => 'Lang can\'t be null'
                    ],
                    'result' => null
                ], 200);
        }
        $label = ($lang == 'en') ? '_en' : '';
        $help_tipster = HelpTipster::
            select('id', 'title' . $label . ' as title', 'description' . $label . ' as description')->
            get();
            
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

    function dangerous_good_info(Request $request) {
        $lang = $request->header('lang') ? $request->header('lang') : null;
        if (!$lang) {
            $lang = isset($_GET['lang']) ? $_GET['lang'] : null;
        }
        if (!$lang) {
            return response()->json([
                    'err' => [
                        'code' => 400,
                        'message' => 'Lang can\'t be null'
                    ],
                    'result' => null
                ], 200);
        }

        $infos = DangerousGoodInfo::select('id', 'description' . ($lang == 'en' ? '_en' : '') . ' as description')->get();

        return response()->json([
            'err' => null,
            'result' => $infos
        ], 200);
    }
}
