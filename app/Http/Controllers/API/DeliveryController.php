<?php

namespace App\Http\Controllers\API;

use App\FlightBookingList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FCMSender;
use App\Http\Controllers\BirdSenderController;

use App\SlotList;
use App\MemberList;
use App\AirportList;
use App\PriceList;
use App\DeliveryStatus;
use App\CityList;
use App\AirlinesList;
use App\AirportcityList;
use App\Shipment;
use App\DaftarBarangGold;
use App\DaftarBarangRegular;
use App\ShipmentStatus;

class DeliveryController extends Controller
{
    //

    function submit(Request $request) {
        $member = MemberList::find($request->id_member);

        if($member == null) {
            $data = array(
                'err' => [
                    'code' => 0,
                    'message' => 'Member tidak ditemukan'
                ],
                'result' => null
            );
        } else {
            do{
                $random_string = $this->generateRandomString();
            }while(SlotList::where('slot_id', $random_string)->first() != null);

            $airport_origin = AirportList::find($request->id_origin_airport);
            $airport_destination = AirportList::find($request->id_destination_airport);
            $price = PriceList::where('id_origin_city', $airport_origin->id_city)->where('id_destination_city', $airport_destination->id_city)->first();

            $slot = new SlotList;
            $slot->slot_id = $random_string;
            $slot->id_member = $member->id;
            $slot->booking_code = $request->booking_code;
            $slot->id_airline = FlightController::getAirlineIdOfFlightCode($request->flight_code);
            $slot->id_origin_airport = $request->id_origin_airport;
            $slot->id_destination_airport = $request->id_destination_airport;
            $slot->depature = date('Y-m-d H:i:s', strtotime($request->depature));
//            $slot->arrival = date('Y-m-d H:i:s', strtotime($request->arrival));
            $slot->first_name = $request->first_name;
            $slot->last_name = $request->last_name;
            $slot->flight_code = $request->flight_code;
            $slot->baggage_space = $request->baggage_space; // bagian ini jangan di hardcode
            $slot->slot_price_kg = $price->tipster_price;
            $slot->id_origin_city = $airport_origin->id_city;
            $slot->id_destination_city = $airport_destination->id_city;
            $slot->origin_city = AirportcityList::find($airport_origin->id_city)->name;
            $slot->destination_city = AirportcityList::find($airport_destination->id_city)->name;

            $slot->save();

            $slot = SlotList::find($slot->id);

            $slot->origin_airport = $airport_origin;
            $slot->destination_airport = $airport_destination;
            $delivery_status = DeliveryStatus::find($slot->id_slot_status);
            $slot->delivery_status_description = $delivery_status->description;

            $ms_user = MemberList::find($slot->id_member);
            $mess = 'Terima kasih atas kepercayaan Anda untuk menggunakan TIPS. Penerbangan Anda sudah terdaftar dalam sistem kami dengan kode ' . $slot->slot_id;
            $firebase_sent = "";
            if($ms_user){
                if($ms_user->token) {
                    FCMSender::post(array(
                        'type' => 'Delivery',
                        'id' => $slot->slot_id,
                        'status' => "1",
                        'message' => $mess,
                        'detail' => ""
                    ), $ms_user->token);
                    $firebase_sent = \Carbon\Carbon::now()->toDateTimeString();
                }else{
                    $firebase_sent = "only user, no token";
                }

                $bsc = new BirdSenderController;
                $email = $ms_user->email;
                $nama = $ms_user->first_name . ' ' . $ms_user->last_name;
                $antarcode = $slot->slot_id;
                $bsc->sendMailTipsterStep1($email, $nama, $antarcode);
            }else{
                $firebase_sent = "no user: " . $slot->slot_id;
            }

            $data = array(
                'err' => null,
                'firebase_sent_time' => $firebase_sent,
                'slot' => $slot
            );
        }

        return response()->json($data, 200);
    }

    private function getDetailStatus($delivery){
        switch ($delivery->id_slot_status) {
            case '3':
                # code...
                break;
            
            default:
                # code...
                break;
        }
    }

    public static function ___get_status($slot_id){
        $slot = SlotList::where('slot_id', $slot_id)->first();

        if($slot == null) {
            return null;
        } else {
            $delivery_status = DeliveryStatus::find($slot->id_slot_status);
            $slot->origin_airport = AirportList::find($slot->id_origin_airport);
            $slot->destination_airport = AirportList::find($slot->id_destination_airport);
            if($slot->photo_tag){
                $slot->photo_tag = url('/image/photo_tag').'/'.$slot->photo_tag;
            }

            return array(
                'status' => array(
                    'step' => $delivery_status->step,
                    'description' => $delivery_status->description,
                    'detail' => $slot->detail_status
                ),
                'delivery' => $slot,
                'addt_info' => array(
                    'kode_bandara_asal' => $slot->airportOrigin->initial_code,
                    'kode_bandara_tujuan' => $slot->airportDestination->initial_code,
                    'airline_name' => $slot ? FlightController::getAirlineNameOfFlightCode($slot->flight_code) : ""
                )
            );
        }
    }

    function get_status(Request $request) {
        $slot_id = $request->slot_id;
        $resdata = DeliveryController::___get_status($slot_id);

        if($resdata == null) {
            $data = array(
                'err' => [
                    'code' => 0,
                    'message' => 'Slot id tidak ditemukan'
                ],
                'result' => null
            );
        } else {
            $data = array(
                'err' => null,
                'result' => $resdata
            );
        }

        return response()->json($data, 200);
    }

    function confirm(Request $request) {
        $slot = SlotList::where('slot_id', $request->slot_id)->first();
        if($slot == null) {
            $data = array(
                'err' => [
                    'code' => 0,
                    'message' => 'Slot id tidak ditemukan'
                ],
                'result' => null
            );
        } else {
            $confirmation = $request->confirmation;
            $shipments = Shipment::where('id_slot', $slot->id)->get();

            if($confirmation == 0) {
                $slot->status_dispatch = 'Canceled';
                $slot->id_slot_status = 0;
                $slot->save();

                $slot = SlotList::where('slot_id', $request->slot_id)->delete();

                foreach ($shipments as $shipment) {
                    $shipment->status_dispatch = 'Pending';
                    $shipment->id_shipment_status = 4;
                    $shipment->id_slot = null;
                    $shipment->save();

                    if($shipment->is_first_class) {
                        $daftar_barang = DaftarBarangGold::where('id_barang', $shipment->id)->first();
                    } else {
                        $daftar_barang = DaftarBarangRegular::where('id_barang', $shipment->id)->first();
                    }

                    $daftar_barang->is_assigned = false;
                    $daftar_barang->save();

                }

                $data = array(
                    'err' => null,
                    'result' => $slot
                );

            } else {
                $slot->status_dispatch = 'Process';
                $slot->id_slot_status = 3;
                $slot->save();


                foreach ($shipments as $shipment) {
                    $shipment->status_dispatch = 'Process';
                    $shipment->save();

                    if($shipment->is_first_class) {
                        $daftar_barang = DaftarBarangGold::where('id_barang', $shipment->id)->delete();
                    } else {
                        $daftar_barang = DaftarBarangRegular::where('id_barang', $shipment->id)->delete();
                    }

                }

                $delivery_status = DeliveryStatus::find($slot->id_slot_status);
                $slot->origin_airport = AirportList::find($slot->id_origin_airport);
                $slot->destination_airport = AirportList::find($slot->id_destination_airport);

                $data = array(
                    'err' => null,
                    'result' => array(
                        'status' => array(
                            'step' => $delivery_status->step,
                            'description' => $delivery_status->description,
                            'detail' => $slot->detail_status
                        ),
                        'delivery' => $slot,
                        'addt_info' => array(
                            'kode_bandara_asal' => $slot->airportOrigin->initial_code,
                            'kode_bandara_tujuan' => $slot->airportDestination->initial_code,
                            'airline_name' => $slot ? FlightController::getAirlineNameOfFlightCode($slot->flight_code) : ""
                        )
                    )
                );

                $ms_user = MemberList::find($slot->id_member);
                $mess = 'Pastikan Anda tiba di bandara ' . $slot->airportOrigin->name . ' pada pukul <<TEST>>' . ' untuk mengambil barang antaran TIPS';
                $firebase_sent = "";
                if($ms_user){
                    if($ms_user->token) {
                        FCMSender::post(array(
                            'type' => 'Delivery',
                            'id' => $slot->slot_id,
                            'status' => "3",
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

                $bsc = new BirdSenderController;
                $email = $ms_user->email;
                $nama = $ms_user->first_name . ' ' . $ms_user->last_name;
                $antarcode = $slot->slot_id;
                $waktu_3_jam_sebelumnya = date('Y-m-d H:i:s', strtotime($slot->depature) - (60 * 60 * 3));
                $bsc->sendMailTipsterStep3($email, $nama, $antarcode, $slot->airportOrigin->name, $waktu_3_jam_sebelumnya, "+62 823 1777 6008");
            }
        }

        return response()->json($data, 200);
    }

    function send_tag(Request $request) {
        $slot = SlotList::where('slot_id', $request->slot_id)->first();
        if($slot == null) {
            $data = array(
                'err' => [
                    'code' => 0,
                    'message' => 'Slot id tidak ditemukan'
                ],
                'result' => null
            );
        } else if(!$request->has('photo_tag')){
            $data = array(
                'err' => [
                    'code' => 0,
                    'message' => 'Photo tag tidak ada'
                ],
                'result' => null
            );
        } else{
            $file = $request->file('photo_tag');

            $dataImg = $file;
            $t = microtime(true);
            $micro = sprintf("%06d", ($t - floor($t)) * 1000000);
            $timestamp = date('YmdHis' . $micro, $t) . "_" . rand(0, 1000);

            $ext_file = $dataImg->getClientOriginalExtension();
            $name_file = $timestamp . '_img_item.' . $ext_file;
            $path_file = public_path() . '/image/photo_tag/';

            if($dataImg->move($path_file,$name_file)) {
                $slot->photo_tag = $name_file;
            }

            $shipments = Shipment::where('id_slot', $slot->id)->get();

            $slot->id_slot_status = 5;
            $slot->save();
            $shipment_status = ShipmentStatus::where('step', 5)->first();

            foreach ($shipments as $shipment) {

                $shipment->id_shipment_status = $shipment_status->id;
                $shipment->save();


                $member = MemberList::find($shipment->id_shipper);

                if($member != null) {
                    if($member->token != null) {
                        FCMSender::post(array(
                            'type' => 'Shipment',
                            'id' => $shipment->shipment_id,
                            'status' => "5",
                            'message' => $shipment_status->description,
                            'detail' => ""
                        ), $member->token);
                    }
                }
            }

            $ms_user = MemberList::find($slot->id_member);
            $mess = 'Selamat menikmati perjalanan Anda. Setibanya di bandara tujuan, serahkan barang antaran TIPS kepada petugas TIPS di bandara tujuan.';
            $firebase_sent = "";
            if($ms_user){
                if($ms_user->token) {
                    FCMSender::post(array(
                        'type' => 'Delivery',
                        'id' => $slot->slot_id,
                        'status' => "5",
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

            $delivery_status = DeliveryStatus::find($slot->id_slot_status);
            $slot->origin_airport = AirportList::find($slot->id_origin_airport);
            $slot->destination_airport = AirportList::find($slot->id_destination_airport);
            $slot->photo_tag = url('/image/photo_tag').'/'.$slot->photo_tag;
            $data = array(
                'err' => null,
                'result' => array(
                    'status' => array(
                        'step' => $delivery_status->step,
                        'description' => $delivery_status->description,
                        'detail' => $slot->detail_status
                    ),
                    'delivery' => $slot,
                    'addt_info' => array(
                        'kode_bandara_asal' => $slot->airportOrigin->initial_code,
                        'kode_bandara_tujuan' => $slot->airportDestination->initial_code,
                        'airline_name' => $slot ? FlightController::getAirlineNameOfFlightCode($slot->flight_code) : ""
                    )
                )
            );

        }

        return response()->json($data, 200);
    }

    function search_delivery(Request $request) {
        $slot_list = SlotList::withTrashed()->where('id_member', $request->id_member);

        if($request->has('id_destination_airport')){
            if($request->id_destination_airport != null && $request->id_destination_airport != "") {
                $slot_list = $slot_list->where('id_destination_airport', $request->id_destination_airport);
            }
        }

        if($request->has('id_slot_status')){
            if($request->id_slot_status != null && $request->id_slot_status != "" && $request->id_slot_status != 0) {
                $slot_list = $slot_list->where('id_slot_status', $request->id_slot_status);
            }
        }

        if($request->has('start_depature') && $request->has('end_depature')){
            if($request->start_depature != null && $request->start_depature != "" && $request->end_depature != null && $request->end_depature != "") {
                $slot_list = $slot_list->where('depature','>=' ,$request->start_depature)->where('depature','<=' ,$request->end_depature);
            }
        }

        $slot_list_init = $slot_list->get();
        $slot_list = [];

        foreach ($slot_list_init as $slot) {
            $airport_origin = AirportList::find($slot->id_origin_airport);
            $airport_destination = AirportList::find($slot->id_destination_airport);


            $slot->origin_airport = $airport_origin;
            $slot->destination_airport = $airport_destination;

            if($slot->id_slot_status != 0) {
                $delivery_status = DeliveryStatus::find($slot->id_slot_status);
                $slot->delivery_status_description = $delivery_status->description;
            } else {
                $slot->delivery_status_description = 'Batal';
            }

            array_push($slot_list, $slot);
        }

        $data = array(
            'err' => null,
            'result' => $slot_list
        );

        return response()->json($data, 200);

    }

    function get_all_status_delivery() {
        $delivery_status = DeliveryStatus::all();

        $data = array(
            'err' => null,
            'result' => $delivery_status
        );

        return response()->json($data, 200);
    }

    function generateRandomString($length = 7) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
