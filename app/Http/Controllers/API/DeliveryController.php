<?php

namespace App\Http\Controllers\API;

use App\FlightBookingList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FCMSender;

use App\SlotList;
use App\MemberList;
use App\AirportList;
use App\PriceList;
use App\DeliveryStatus;
use App\CityList;
use App\Shipment;
use App\DaftarBarangGold;
use App\DaftarBarangRegular;
use App\ShipmentStatus;

class DeliveryController extends Controller
{
    //

    function submit(Request $request) {
        $member = MemberList::find($request->id_member);
        $booking = FlightBookingList::where('booking_code', $request->booking_code)->first();
        $slot = SlotList::where('booking_code', $request->booking_code)->first();

        if($member == null) {
            $data = array(
                'err' => [
                    'code' => 0,
                    'message' => 'Member tidak ditemukan'
                ],
                'result' => null
            );
        } else if($booking == null) {
            $data = array(
                'err' => [
                    'code' => 0,
                    'message' => 'Booking tidak ditemukan'
                ],
                'result' => null
            );
        } else if($slot != null){
            $data = array(
                'err' => [
                    'code' => 0,
                    'message' => 'Booking telah didaftarkan'
                ],
                'result' => null
            );
        } else {
            do{
                $random_string = $this->generateRandomString();
            }while(SlotList::where('slot_id', $random_string)->first() != null);

            $airport_origin = AirportList::find($booking->id_origin_airport);
            $airport_destination = AirportList::find($booking->id_destination_airport);
            $price = PriceList::where('id_origin_city', $airport_origin->id_city)->where('id_destination_city', $airport_destination->id_city)->first();

            $slot = new SlotList;
            $slot->slot_id = $random_string;
            $slot->id_member = $member->id;
            $slot->booking_code = $booking->booking_code;
            $slot->id_airline = $booking->id_airline;
            $slot->id_origin_airport = $booking->id_origin_airport;
            $slot->id_destination_airport = $booking->id_destination_airport;
            $slot->depature = $booking->depature;
            $slot->arrival = $booking->arrival;
            $slot->flight_code = $booking->flight_code;
            $slot->baggage_space = $request->baggage_space;
            $slot->slot_price_kg = $price->tipster_price;
            $slot->origin_city = CityList::find($airport_origin->id_city)->name;
            $slot->destination_city = CityList::find($airport_destination->id_city)->name;

            $slot->save();

            $slot->origin_airport = $airport_origin;
            $slot->destination_airport = $airport_destination;



            $data = array(
                'err' => null,
                'slot' => $slot
            );
        }

        return response()->json($data, 200);
    }

    function get_status(Request $request) {
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
            $data = array(
                'err' => null,
                'result' => array(
                    'status' => array(
                        'step' => $delivery_status->step,
                        'description' => $delivery_status->description,
                        'detail' => $slot->detail_status
                    ),
                    'delivery' => $slot
                )

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
                $slot->dispatch_type = 'Canceled';
                $slot->save();

                foreach ($shipments as $shipment) {
                    $shipment->dispatch_type = 'Pending';
                    $shipment->id_slot_status = 1;
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
                $slot->dispatch_type = 'Process';
                $slot->id_slot_status = 3;
                $slot->save();
                $shipment_status = ShipmentStatus::where('step', 2)->first();

                foreach ($shipments as $shipment) {
                    $shipment->dispatch_type = 'Process';
                    $shipment->id_slot_status = 2;
                    $shipment->save();

                    if($shipment->is_first_class) {
                        $daftar_barang = DaftarBarangGold::where('id_barang', $shipment->id)->delete();
                    } else {
                        $daftar_barang = DaftarBarangRegular::where('id_barang', $shipment->id)->delete();
                    }

                    $member = MemberList::find($shipment->id_shipper);

                    if($member->token != null) {
                        FCMSender::post(array(
                            'type' => 'Shipment',
                            'id' => $shipment->shipment_id,
                            'status' => "2",
                            'message' => $shipment_status->description,
                            'detail' => ""
                        ), $member->token);
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
                        'delivery' => $slot
                    )
                );
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

                $shipment->id_shipment_status = 5;
                $shipment->save();


                $member = MemberList::find($shipment->id_shipper);

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
                    'delivery' => $slot
                )
            );

        }

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
