<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Feedback;

class FeedbackController extends Controller
{
    //
    public function submit(Request $request) {
        $feedback = new Feedback;
        $feedback->member_id = $request->id;
        $feedback->topik = $request->topik;
        $feedback->isi = $request->isi;

        $feedback->save();

        $data = array(
            'err' => null,
            'result' => [
                'code' => 1,
                'message' => 'Berasil mensubmit feedback'
            ]
        );

        return response()->json($data, 200);
    }
}
