<?php

namespace App\Http\Controllers\API;

use App\Shipment;
use App\SlotList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DateTime;

class HomeController extends Controller
{

    function isADayAfter($datetime_instance){
        $checkTime = (new DateTime($datetime_instance))->modify('+1 day');
        $nowTime = new DateTime();
        // echo $checkTime->format('Y-m-d h:i') . '; ';
        // echo $nowTime->format('Y-m-d h:i') . '; ';
        return $checkTime <= $nowTime;
    }

    //
    function list_of_shipment_and_delivery(Request $request){
        $member_id = $request->member_id;
        $device_id = $request->has('device_id') ? $request->device_id : "";

        if($device_id)        
            // $shipments = Shipment::select('shipment_id','status_dispatch','id_shipment_status','updated_at')->where('id_shipper', $member_id)->orWhere('id_device', $device_id)->get(); // OLD
            $shipments = Shipment::where('id_shipper', $member_id)->orWhere('id_device', $device_id)->get();
        else
            // $shipments = Shipment::select('shipment_id','status_dispatch','id_shipment_status','updated_at')->where('id_shipper', $member_id)->get(); // OLD
            $shipments = Shipment::where('id_shipper', $member_id)->get();
        // $delivery = SlotList::select('slot_id','status_dispatch', 'sold_baggage_space', 'slot_price_kg', 'id_slot_status', 'updated_at')->where('id_member', $member_id)->get(); // OLD
        $delivery = SlotList::where('id_member', $member_id)->get();

        // dd($member_id, SlotList::all());

        $outshipment = [];
        foreach ($shipments as $key => $shipment){
            if(!($shipment->id_shipment_status == 15 && $this->isADayAfter($shipment->updated_at)) && !$shipment->trashed()){
                array_push($outshipment, ShipmentController::___get_status($shipment->shipment_id));
            }
        }

        $outdelivery = [];
        foreach ($delivery as $key => $deliv){
            if(!($deliv->id_slot_status == 7 && $this->isADayAfter($deliv->updated_at)))
                array_push($outdelivery, DeliveryController::___get_status($deliv->slot_id));
        }
        
        $data = array(
            'err' => null,
            'result' => array (
                'shipments' => $outshipment,
                'delivery' => $outdelivery,
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
