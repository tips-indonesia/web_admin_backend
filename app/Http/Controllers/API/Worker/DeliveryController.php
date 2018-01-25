<?php

namespace App\Http\Controllers\API\Worker;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FCMSender;

use App\SlotList;
use App\DeliveryStatus;
use App\MemberList;
use App\AirportList;
use App\Shipment;
use App\ShipmentStatus;
use App\PackagingList;
use App\DaftarBarangGold;
use App\DaftarBarangRegular;

class DeliveryController extends Controller
{
    //
    function get_detail(Request $request) {

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
        } else {
            $delivery_status = DeliveryStatus::find($slot->id_slot_status);
            $slot->origin_airport = AirportList::find($slot->id_origin_airport);
            $slot->destination_airport = AirportList::find($slot->id_destination_airport);
            if($slot->photo_tag){
                $slot->photo_tag = url('/image/photo_tag').'/'.$slot->photo_tag;
            }

            $user = MemberList::find($slot->id_member);
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

    function departure(Request $request) {
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
        } else if($slot->id_slot_status != 3 || $slot->status_dispatch != "Process"){
            $data = array(
                'err' => [
                    'code' => 0,
                    'message' => 'Slot belum dilakukan konfirmasi/ Slot tidak aktif'
                ],
                'result' => null
            );
        } else {
            $slot->id_slot_status = 4;
            $slot->save();

            $packaging_list = PackagingList::where('id_slot', $slot->id)->first();
            $packaging_list->is_receive = 2;

            $packaging_list->save();

            $shipments = Shipment::where('id_slot', $slot->id)->get();
            $shipment_status = ShipmentStatus::where('step', 4)->first();

            foreach ($shipments as $shipment) {
                $shipment->id_shipment_status = $shipment_status->id;
                $shipment->save();
            }


            $delivery_status = DeliveryStatus::find($slot->id_slot_status);
            $slot->origin_airport = AirportList::find($slot->id_origin_airport);
            $slot->destination_airport = AirportList::find($slot->id_destination_airport);
            $user = MemberList::find($slot->id_member);

            if($user->token != 0) {
                FCMSender::post(array(
                    'type' => 'Delivery',
                    'id' => $slot->slot_id,
                    'status' => "4",
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
