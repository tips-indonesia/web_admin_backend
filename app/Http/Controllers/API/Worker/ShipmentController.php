<?php

namespace App\Http\Controllers\API\Worker;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Shipment;
use App\MemberList;
use App\ShipmentStatus;
use App\AirportcityList;
use App\PriceList;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\FCMSender;
use App\Http\Controllers\BirdSenderController;
use App\Http\Controllers\cURLFaker;
use App\Http\Controllers\API\PromotionController;

class ShipmentController extends Controller
{
    //
    function get_detail(Request $request) {

        $shipment_id = $request->shipment_id;
        $is_arrival = $request->is_arrival;
        $id_worker = $request->id_worker;

        if(!$shipment_id || !$is_arrival || !$id_worker){
            $data = array(
                'err' => [
                    'code' => 0,
                    'message' => 'Paramter tidak boleh kosong'
                ],
                'result' => null
            );
            return response()->json($data, 200);
        }

        $shipment = Shipment::where('shipment_id', $shipment_id)->where('status_dispatch','<>','Canceled')->first();
        $member_list = MemberList::find($id_worker);
        $is_arrival = $is_arrival == 1;

        if($shipment == null || $member_list == null) {
            $data = array(
                'err' => [
                    'code' => 0,
                    'message' => 'Shipment atau Worker tidak ditemukan'
                ],
                'result' => null
            );
        } else if(!$member_list->isOfficeRight($is_arrival ? $shipment->id_origin_city : $shipment->id_destination_city)){
            $data = array(
                'err' => [
                    'code' => 0,
                    'message' => 'akses Shipment ditolak'
                ],
                'result' => null
            );
        } else {
            $shipment_status = ShipmentStatus::find($shipment->id_shipment_status);
            $shipment->origin_city = AirportcityList::find($shipment->id_origin_city);
            $shipment->destination_city = AirportcityList::find($shipment->id_destination_city);

            $data = array(
                'err' => null,
                'result' => array(
                    'status' => array(
                        'step' => $shipment_status->step,
                        'description' => $shipment_status->description,
                        'detail' => $shipment->detail_status
                    ),
                    'shipment' => $shipment,
                )

            );
        }
        return response()->json($data, 200);
    }

    function getMyShipmentsDeparture(Request $req){
        return $this->getMyShipmentsGeneral($req, 'pickup_by');
    }

    function getMyShipmentsSDelivery(Request $req){
        return $this->getMyShipmentsGeneral($req, 'delivered_by');
    }

    function getMyShipmentsGeneral(Request $req, $type){
        $worker_id = $req->worker_id;
        if($worker_id == null){
            $data = array(
                'err' => [
                    'code' => 500,
                    'message' => 'Worker id harus diisi'
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

        $data = array(
            'err' => null,
            'result' => [
                'shipments' => Shipment::where($type, $worker_id)->get()
            ]
        );

        return response()->json($data, 200);
    }

    function pickup(Request $request) {

        $shipment_id = $request->shipment_id;
        $photo_signature = $request->file('photo_signature');

        if($photo_signature == null || $shipment_id == null || $request->estimate_weight == null){
            $data = array(
                'err' => [
                    'code' => 0,
                    'message' => 'Foto shipment id, estimate weight, atau tanda tangan tidak boleh kosong'
                ],
                'result' => null
            );

            return response()->json($data, 400);
        }

        // save photo to storage and get photo url
        // ##########
        // BEGIN
        // #
        $data_img_signature = $photo_signature;
        $ext_file_signature = $data_img_signature->getClientOriginalExtension();
        $name_file_signature = "" . uniqid() . '_img_item.' . $ext_file_signature;
        $path_file_signature = public_path() . '/image/shipment/signature';

        $photo_ttd_url = "";
        if($data_img_signature->move($path_file_signature, $name_file_signature)) {
            $photo_ttd_url = URL::to('/image/shipment/signature/' . $name_file_signature);
        }
        // #
        // END
        // ##########

        $shipment = Shipment::where('shipment_id', $shipment_id)->where('status_dispatch','<>','Canceled')->first();
        if($shipment == null) {
            $data = array(
                'err' => [
                    'code' => 0,
                    'message' => 'Shipment id tidak ditemukan'
                ],
                'result' => null
            );
        } else {

            $price = PriceList::where('id_origin_city', $shipment->id_origin_city)
                    ->where('id_destination_city', $shipment->id_destination_city)->first();

            $promo_percent = 0;
            $promotion = PromotionController::getUserPromoOrNULL($shipment->id_shipper);
            if($promotion['promo']){
                $promo_percent = $promotion['promo']->discount_value / 100;
            }

            $shipment->real_weight = $request->estimate_weight;
            $shipment->status_dispatch = "Process";
            $shipment->id_shipment_status = 3;
            $shipment->pickup_signature = $photo_ttd_url;

            // update flight cost to real weight after pickup
            $shipment->flight_cost = $shipment->real_weight * $price->freight_cost;
            $shipment->flight_cost -= $promo_percent * $shipment->flight_cost;

            $shipment->save();

            // KIRIM
            // pada saat Worker Submit Pick up
            // (status shipment dari 1 menjadi 2)
            $shipment->create_transaction();

            $shipment = Shipment::where('shipment_id', $shipment_id)->first();
            $shipment_status = ShipmentStatus::find($shipment->id_shipment_status);
            $shipment->origin_city = AirportcityList::find($shipment->id_origin_city);
            $shipment->destination_city = AirportcityList::find($shipment->id_destination_city);

            $data = array(
                'err' => null,
                'result' => array(
                    'status' => array(
                        'step' => $shipment_status->step,
                        'description' => $shipment_status->description,
                        'detail' => $shipment->detail_status
                    ),
                    'shipment' => $shipment,
                )

            );
        }
        return response()->json($data, 200);
    }

    function upload_signature(Request $request) {
        $shipment_id = $request->shipment_id;
        $shipment = Shipment::where('shipment_id', $shipment_id)->first();

        if($shipment == null) {
            $data = array(
                'err' => [
                    'code' => 0,
                    'message' => 'Shipment id tidak ditemukan'
                ],
                'result' => null
            );
        } else {
            $file_ktp = $request->file('photo_ktp');
            $file_signature = $request->file('photo_signature');


            $t = microtime(true);
            $micro = sprintf("%06d", ($t - floor($t)) * 1000000);
            $timestamp = date('YmdHis' . $micro, $t) . "_" . rand(0, 1000);

            $data_img_ktp = $file_ktp;
            $ext_file_ktp = $data_img_ktp->getClientOriginalExtension();
            $name_file_ktp = "" . uniqid() . '_img_item.' . $ext_file_ktp;
            $path_file_ktp = public_path() . '/image/shipment/ktp';

            $data_img_signature = $file_signature;
            $ext_file_signature = $data_img_signature->getClientOriginalExtension();
            $name_file_signature = "" . uniqid() . '_img_item.' . $ext_file_signature;
            $path_file_signature = public_path() . '/image/shipment/signature';

            if($data_img_ktp->move($path_file_ktp,$name_file_ktp)) {
                $shipment->photo_ktp = URL::to('/image/shipment/ktp/' . $name_file_ktp);
            }

            if($data_img_signature->move($path_file_signature,$name_file_signature)) {
                $shipment->photo_signature = URL::to('/image/shipment/signature/' . $name_file_signature);
            }

            $shipment->received_by = $request->received_by;
            $shipment->received_time = date('Y-m-d H:i:s');
            $shipment->id_shipment_status = 15;

            $shipment->save();

            $ms_user = MemberList::find($shipment->id_shipper);
            $mess = 'Barang kiriman Anda dengan kode pengiriman ' . $shipment->shipment_id . ' sudah diambil oleh: '
                    . $shipment->consignee_first_name . " " . $shipment->consignee_last_name;
            if($ms_user){
                if($ms_user->token) {
                    FCMSender::post(array(
                        'type' => 'Shipment',
                        'id' => $shipment->shipment_id,
                        'status' => "8",
                        'message' => $mess,
                        'detail' => ""
                    ), $ms_user->token);
                }
                $bsc = new cURLFaker;
                $email = $ms_user->email;
                $nama = $ms_user->first_name . ' ' . $ms_user->last_name;
                $kirimcode = $shipment->shipment_id;
                $penerima = $shipment->received_by;

                if($email)
                    $bsc->sendMailShipperStep8($email, $nama, $kirimcode, $penerima);
            }

            $data = array(
                'err' => null,
                'result' => [
                    'code' => 1,
                    'message' => $mess
                ]
            );
        }

        return response()->json($data, 200);
    }


}
