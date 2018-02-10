<?php

namespace App\Http\Controllers\API;

use App\Shipment;
use App\SlotList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    //
    function list_of_shipment_and_delivery(Request $request){
        $member_id = $request->member_id;

        $shipments = Shipment::select('shipment_id','status_dispatch')->where('id_shipper', $member_id)->where('status_dispatch','<>','Canceled')->get();
        $delivery = SlotList::select('slot_id','status_dispatch')->where('id_member', $member_id)->get();

        $data = array(
            'err' => null,
            'result' => array (
                'shipments' => $shipments,
                'delivery' => $delivery
            )
        );

        return response()->json($data, 200);
    }
}
