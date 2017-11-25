<?php

namespace App\Http\Controllers\API\Worker;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\SlotList;
use App\AirportList;


class ArrivalController extends Controller
{
    //
    function get_list() {
        $slots_init = SlotList::where('id_slot_status', 5)->get();
        $slots = [];

        foreach ($slots_init as $slot) {
            $slot->origin_airport = AirportList::find($slot->id_origin_airport);
            $slot->destination_airport = AirportList::find($slot->id_destination_airport);
            if($slot->photo_tag != null){
                $slot->photo_tag = url('/image/photo_tag').'/'.$slot->photo_tag;

            }

            array_push($slots, $slot);

        }

        $data = array(
            'err' => null,
            'result' => array(
                'delivery' => $slots
            )

        );

        return response()->json($data, 200);
    }
}
