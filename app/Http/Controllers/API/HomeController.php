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
        $device_id = $request->has('device_id') ? $request->device_id : "";

        if($device_id)        
            $shipments = Shipment::select('shipment_id','status_dispatch')->where('id_shipper', $member_id)->orWhere('id_device', $device_id)->get();
        else
            $shipments = Shipment::select('shipment_id','status_dispatch')->where('id_shipper', $member_id)->get();
        $delivery = SlotList::select('slot_id','status_dispatch', 'sold_baggage_space', 'slot_price_kg', 'id_slot_status')->where('id_member', $member_id)->get();

        // dd($member_id, SlotList::all());

        $data = array(
            'err' => null,
            'result' => array (
                'shipments' => $shipments,
                'delivery' => $delivery,
                'money' => $this->getMoney($member_id)
            )
        );

        return response()->json($data, 200);
    }

    function getMoney($id){
        $my_slots = SlotList::where('id_member', $id)->where('id_slot_status', 7)->get();
        return 0;

        $sum_money = 0.00;
        foreach ($my_slots as $slot)
            $sum_money += $slot->sold_baggage_space * $slot->slot_price_kg;

        return $sum_money;
    }
}
