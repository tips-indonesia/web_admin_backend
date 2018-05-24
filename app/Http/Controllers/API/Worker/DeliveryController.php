<?php

namespace App\Http\Controllers\API\Worker;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FCMSender;
use App\Http\Controllers\API\Worker\ShipmentController;

use App\SlotList;
use App\DeliveryStatus;
use App\MemberList;
use App\AirportList;
use App\Shipment;
use App\ShipmentStatus;
use App\PackagingList;
use App\DaftarBarangGold;
use App\DaftarBarangRegular;

use DB;
use stdClass;

class DeliveryController extends Controller
{

    function get_manifest(Request $req){
        $MANIFEST_TYPE_TODAY = 'today';
        $MANIFEST_TYPE_TOMORROW = 'tomorrow';

        $MANIFEST_TYPE_DEPARTURE = 'departure';
        $MANIFEST_TYPE_ARRIVAL = 'arrival';

        $worker_id = $req->worker_id;
        $today_or_tomorrow = $req->today_or_tomorrow;
        $departure_or_arrival = $req->departure_or_arrival;

        if($worker_id == null || $today_or_tomorrow == null || $departure_or_arrival == null){
            $data = array(
                'err' => [
                    'code' => 400,
                    'message' => 'Worker id, today or tomorrow, departure or arrival harus diisi'
                ],
                'result' => null
            );

            return response()->json($data, 200);
        }

        if($today_or_tomorrow != $MANIFEST_TYPE_TODAY && $today_or_tomorrow != $MANIFEST_TYPE_TOMORROW){
            $data = array(
                'err' => [
                    'code' => 400,
                    'message' => 'Today or tomorrow parameter salah'
                ],
                'result' => null
            );

            return response()->json($data, 200);
        }

        if($departure_or_arrival != $MANIFEST_TYPE_DEPARTURE && $departure_or_arrival != $MANIFEST_TYPE_ARRIVAL){
            $data = array(
                'err' => [
                    'code' => 400,
                    'message' => 'Departure or arrival parameter salah'
                ],
                'result' => null
            );

            return response()->json($data, 200);
        }

        $worker_instance = MemberList::find($worker_id);
        if($worker_instance == null){
            $data = array(
                'err' => [
                    'code' => 404,
                    'message' => 'Worker tidak ditemukan'
                ],
                'result' => null
            );

            return response()->json($data, 200);
        }

        $timezone = "Asia/Jakarta";
        date_default_timezone_set($timezone);
        
        $nowDateStr = (string) \Carbon\Carbon::now()->format('d/m/Y');
        $tomDateStr = (string) \Carbon\Carbon::now()->addDays(1)->format('d/m/Y');
        $nextTomDateStr = (string) \Carbon\Carbon::now()->addDays(2)->format('d/m/Y');

        $nowDate = \Carbon\Carbon::createFromFormat('d/m/Y', $nowDateStr);
        $tomDate = \Carbon\Carbon::createFromFormat('d/m/Y', $tomDateStr);
        $nextTomDate = \Carbon\Carbon::createFromFormat('d/m/Y', $nextTomDateStr);

        $isToday = ($today_or_tomorrow == $MANIFEST_TYPE_TODAY);
        $isDeparture = ($departure_or_arrival == $MANIFEST_TYPE_DEPARTURE);

        // get all shipments related
        // $shipments = DB::table('shipments')
        //     ->where('pickup_by', $worker_id)
        //     // filter null slot shipments
        //     ->whereNotNull('shipments.id_slot')


        //     // get slot of shipments
        //     ->leftJoin('slot_lists', 'shipments.id_slot', '=', 'slot_lists.id')


        //     // get packaging by slot
        //     ->leftJoin('packaging_lists', 'slot_lists.id', '=', 'packaging_lists.id_slot')
        //     // filter null package
        //     ->whereNotNull('packaging_lists.id')


        //     // get worker that picking up the shipment
        //     ->leftJoin('member_lists', $isDeparture ? 'shipments.pickup_by' : 'shipments.delivered_by', '=', 'member_lists.id')
        //     // filter null worker
        //     ->whereNotNull('member_lists.id')


        //     // get office of worker
        //     ->leftJoin('office_lists', 'member_lists.id_office', '=', 'office_lists.id')
        //     // filter worker with null office
        //     ->whereNotNull('office_lists.id')

        //     // filter today or tomorrow
        //     ->where([
        //         ['slot_lists.depature', '>=', $isToday ? $nowDate : $tomDate],
        //         ['slot_lists.depature', '<', $isToday ? $tomDate : $nextTomDate],
        //     ])

        //     // filter
        //     ->whereColumn('office_lists.id_area', $isDeparture ? 'slot_lists.id_origin_city' : 'slot_lists.id_destination_city')
        //     ->select('packaging_lists.packaging_id', 'shipments.id_slot', 
        //              'member_lists.first_name', 'member_lists.last_name', 'slot_lists.id_slot_status', 
        //              'member_lists.mobile_phone_no', 'slot_lists.flight_code',
        //              'slot_lists.depature as departure', 'slot_lists.sold_baggage_space as total_weight')
        //     // ->toSql();
        //     ->get();

        // dd($nowDateStr);
        // $nowDateStr = '08/05/2018';
        $query = "select packaging_lists.packaging_id, packaging_lists.id_slot, slot_lists.first_name, slot_lists.last_name, slot_lists.id_slot_status, slot_lists.flight_code, (select count(*) from shipments where id_slot = slot_lists.id) as total_shipment, (select sum(shipments.real_weight) from shipments where id_slot = slot_lists.id) as total_weight, slot_lists.id_origin_city, slot_lists.id_member, slot_lists.depature as departure, member_lists.mobile_phone_no from packaging_lists inner join slot_lists on slot_lists.id = packaging_lists.id_slot inner join member_lists on member_lists.id = slot_lists.id_member where slot_lists." . ($isDeparture ? 'id_origin_city' : 'id_destination_city') . " = (select id_area from office_lists where id = (select id_office from member_lists where member_lists.id = :workerId)) and DATE_FORMAT(slot_lists.depature,'%d/%m/%Y') = '" . ($isToday ? $nowDateStr : $tomDateStr) . "'";
        $slot_packages = DB::select(DB::raw($query), 
            array(
                'workerId' => $worker_id
            ));

        // dd($slot_packages);

        foreach ($slot_packages as $sp) {
            $sp->status = $sp->id_slot_status == 3 ? 'Pending' : 'Done';
            if($sp->id_slot_status < 3 || $sp->id_slot_status > 5)
                    $sp->status = '?';
        }

        $data = array(
            'err' => null,
            'result' => $slot_packages
        );

        return response()->json($data, 200);
    }

    // test
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
            $packaging_list = PackagingList::where('id_slot', $slot->id)->first();
            if(!$packaging_list){
                $data = array(
                    'err' => [
                        'code' => 0,
                        'message' => 'Barang belum diterima di counter, silahkan hubungi Admin.'
                    ],
                    'result' => null
                );

                return response()->json($data, 200);
            }

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
