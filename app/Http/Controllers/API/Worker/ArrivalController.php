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
use App\DualLanguage;
use App\NotificationText;
use App\Http\Controllers\FCMSender;
use App\Http\Controllers\API\MessageController;


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
        $lang = DualLanguage::getLang($request);

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

            // ANTAR
            // pada saat Worker Arrival Submit
            // (status slot dari 5 menjadi 6)
            $slot->create_transaction();

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

            if (count($shipments) != 0) {
                $ms_user = MemberList::find($shipment->id_shipper);
                $mess = NotificationText::getByKeyWithChange('notifshipper06', $lang, [$shipment->shipment_id], NotificationText::PUSH_COLUMN);//'Barang kiriman Anda dengan kode pengiriman ' . $shipment->shipment_id . ' sudah tiba di bandara tujuan.';
                if($ms_user){
                    if($ms_user->token) {
                        FCMSender::post(array(
                            'type' => 'Shipment',
                            'id' => $shipment->shipment_id,
                            'status' => "6",
                            'message' => $mess,
                            'detail' => ""
                        ), $ms_user->token);
                    }
                    MessageController::sendMessageToUser("TIPS", $ms_user, "Shipment Status", "6", $mess);
                }
            }


            $ms_user = MemberList::find($slot->id_member);
            $mess = NotificationText::getByKey('notiftipster06', $lang, NotificationText::PUSH_COLUMN);//'Barang antaran telah diterima dan dalam proses verifikasi.';
            $firebase_sent = "";
            if($ms_user){
                if($ms_user->token) {
                    FCMSender::post(array(
                        'type' => 'Delivery',
                        'id' => $slot->slot_id,
                        'status' => "6",
                        'message' => $mess,
                        'detail' => ""
                    ), $ms_user->token);
                    $firebase_sent = \Carbon\Carbon::now()->toDateTimeString();
                }else{
                    $firebase_sent = "only user, no token";
                }
                MessageController::sendMessageToUser("TIPS", $ms_user, "Delivery Status", "6", $mess);
            }else{
                $firebase_sent = "no user: " . $slot->slot_id;
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
