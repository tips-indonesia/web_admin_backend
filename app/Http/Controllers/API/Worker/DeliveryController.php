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
            $not_yet_in_counter = false;

            $shipments = Shipment::where('id_slot', $slot->id)->get();

            foreach ($shipments as $shipment) {
                if($shipment->id_shipment_status != 7) {
                    $not_yet_in_counter = true;
                }
            }

            if($not_yet_in_counter) {
                $data = array(
                    'err' => [
                        'code' => 0,
                        'message' => 'Barang belum di counter silahkan hubungi Admin'
                    ],
                    'result' => null
                );

                return response()->json($data, 200);
            }

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

                $ms_user = MemberList::find($shipment->id_shipper);
                $mess = 'Barang kiriman Anda dengan kode pengiriman ' . $shipment->shipment_id . ' sudah diserahkan kepada TIPSTER.';
                if($ms_user)
                    if($ms_user->token) {
                        FCMSender::post(array(
                            'type' => 'Shipment',
                            'id' => $shipment->shipment_id,
                            'status' => "4",
                            'message' => $mess,
                            'detail' => ""
                        ), $ms_user->token);
                    }
            }


            $delivery_status = DeliveryStatus::find($slot->id_slot_status);
            $slot->origin_airport = AirportList::find($slot->id_origin_airport);
            $slot->destination_airport = AirportList::find($slot->id_destination_airport);
            $user = MemberList::find($slot->id_member);

            $ms_user = MemberList::find($slot->id_member);
            $mess = 'Jangan lupa untuk foto label bagasi Anda melalui aplikasi TIPS. Selamat menikmati penerbangan Anda.';
            $firebase_sent = "";
            if($ms_user){
                if($ms_user->token) {
                    FCMSender::post(array(
                        'type' => 'Delivery',
                        'id' => $slot->slot_id,
                        'status' => "4",
                        'message' => $mess,
                        'detail' => ""
                    ), $ms_user->token);
                    $firebase_sent = \Carbon\Carbon::now()->toDateTimeString();
                }else{
                    $firebase_sent = "only user, no token";
                }
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
