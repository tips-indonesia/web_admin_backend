<?php

namespace App\Http\Controllers\API\Worker;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\SlotList;
use App\AirportList;
use App\DeliveryStatus;
use App\Shipment;
use App\ShipmentStatus;
use App\MemberList;
use App\Http\Controllers\FCMSender;


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

    function confirm(Request $request) {
        $slot_id = $request->slot_id;
        $slot = SlotList::where('slot_id', $slot_id)->first();


        if($slot == null) {
            $data = array(
                'err' => [
                    'code' => 0,
                    'message' => 'Slot id tidak ditemukan'
                ],
                'result' => null
            );
        } else if($slot->id_slot_status != 5 || $slot->status_dispatch != "Process"){
            $data = array(
                'err' => [
                    'code' => 0,
                    'message' => 'Slot tidak sedang dalam penerbangan'
                ],
                'result' => null
            );
        } else {
            $slot->id_slot_status = 6;
            $slot->save();

            $shipments = Shipment::where('id_slot', $slot->id)->get();
            $shipment_status = ShipmentStatus::where('step', 6)->first();

            foreach ($shipments as $shipment) {
                $shipment->id_shipment_status = $shipment_status->id;
                $shipment->save();
            }



            $delivery_status = DeliveryStatus::find($slot->id_slot_status);
            $slot->origin_airport = AirportList::find($slot->id_origin_airport);
            $slot->destination_airport = AirportList::find($slot->id_destination_airport);
            $user = MemberList::find($slot->id_member);

            $ms_user = MemberList::find($shipment->id_shipper);
            $mess = 'Barang kiriman Anda dengan kode pengiriman ' . $shipment->shipment_id . ' sudah tiba di bandara tujuan.'
            if($ms_user)
                if($ms_user->token != 0) {
                    FCMSender::post(array(
                        'type' => 'Shipment',
                        'id' => $shipment->shipment_id,
                        'status' => "4",
                        'message' => $mess,
                        'detail' => ""
                    ), $ms_user->token);
                }


            if($user->token != 0) {
                FCMSender::post(array(
                    'type' => 'Delivery',
                    'id' => $slot->slot_id,
                    'status' => "6",
                    'message' => $delivery_status->description,
                    'detail' => ""
                ), $user->token);

            }

            unset($user['password']);
            unset($user['token']);
            $data = array(
                'err' => null,
                'result' => array(
                    'status' => array(
                        'step' => $delivery_status->step,
                        'description' => $delivery_status->description,
                        'detail' => $slot->detail_status
                    ),
                    'delivery' => $slot,
                    'user' => $user
                )

            );
        }
        return response()->json($data, 200);
    }
}
