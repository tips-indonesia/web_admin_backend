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
use App\Http\Controllers\API\MessageController;
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

        if($shipment == null || $member_list == null) {
            $data = array(
                'err' => [
                    'code' => 0,
                    'message' => 'Shipment atau Worker tidak ditemukan'
                ],
                'result' => null
            );
        } else if(!$member_list->isOfficeRight($is_arrival == 'true' ? $shipment->id_destination_city : $shipment->id_origin_city)){
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

    function getRejected(Request $request) {
        $shipment_id = $request->shipment_id;
        $id_worker = $request->id_worker;

        if(!$shipment_id || !$id_worker){
            $data = array(
                'err' => [
                    'code' => 0,
                    'message' => 'Paramter shipment_id dan id_worker tidak boleh kosong'
                ],
                'result' => null
            );
            return response()->json($data, 200);
        }

        $shipment = Shipment::withTrashed()->where('shipment_id', $shipment_id)->first();
        $member_list = MemberList::find($id_worker);

        if($shipment == null || $member_list == null) {
            $data = array(
                'err' => [
                    'code' => 0,
                    'message' => 'Shipment atau Worker tidak ditemukan'
                ],
                'result' => null
            );
        // } else if(!$member_list->isOfficeRight($is_arrival == 'true' ? $shipment->id_destination_city : $shipment->id_origin_city)){
        //     $data = array(
        //         'err' => [
        //             'code' => 0,
        //             'message' => 'akses Shipment ditolak'
        //         ],
        //         'result' => null
        //     );
        } else {
            // $shipment_status = ShipmentStatus::find($shipment->id_shipment_status);
            $shipment->origin_city = AirportcityList::find($shipment->id_origin_city);
            $shipment->destination_city = AirportcityList::find($shipment->id_destination_city);

            $data = array(
                'err' => null,
                'result' => array(
                    // 'status' => array(
                    //     'step' => $shipment_status->step,
                    //     'description' => $shipment_status->description,
                    //     'detail' => $shipment->detail_status
                    // ),
                    'shipment' => $shipment,
                )

            );
        }
        return response()->json($data, 200);
    }
    function getMyShipmentsDeparture(Request $req){
        return $this->getMyShipmentsGeneral($req, 'pickup', false);
    }

    function getMyShipmentsSDelivery(Request $req){
        return $this->getMyShipmentsGeneral($req, 'delivered', false);
    }

    function getShipmentsRejectedDelivery(Request $req) {
        return $this->getMyShipmentsGeneral($req, 'delivered', true);
    }

    function getMyShipmentsGeneral(Request $req, $type, $isForReject){
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
        $worker_id_office_area = $worker_instance->office()->id_area;
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

        if ($isForReject) {
            $shipments = Shipment::withTrashed()->whereIn('id_shipment_status', [-2, -3])
                                   ->where('id_origin_city', $worker_id_office_area)
                                   ->whereRaw('Date(updated_at) = CURDATE()');
        } else {
            $shipments = Shipment::whereRaw('Date(' . $type . '_date) = CURDATE()')
                                   ->where($type == 'pickup' ? 'id_origin_city' : 'id_destination_city', $worker_id_office_area);
        }
        $shipments = $shipments->where($type . '_by', $worker_id);

        $data = array(
            'err' => null,
            'result' => [
                'shipments' => $shipments->get()
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
            $shipment->smsStep2();

            // KIRIM
            // pada saat Worker Submit Pick up
            // (status shipment dari 1 menjadi 2)
            $shipment->create_transaction();
            $shipment->send_mail_receipt();

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
            $shipment->smsStep8();

            $ms_user = MemberList::find($shipment->id_shipper);
            $mess = 'Barang kiriman Anda dengan kode pengiriman ' . $shipment->shipment_id . ' sudah diambil oleh: '
                    . $shipment->received_by;
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
                MessageController::sendMessageToUser("TIPS", $ms_user, "Shipment Status", "8", $mess);
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

    function shipmentRejection (Request $request) {
        $shipment_id = $request->shipment_id;
        $shipment = Shipment::withTrashed()->where('shipment_id', $shipment_id)->first();

        if($shipment == null) {
            $data = array(
                'err' => [
                    'code' => 0,
                    'message' => 'Shipment id tidak ditemukan'
                ],
                'result' => null
            );
        } else {
            if ($request->file('photo_ktp') && $request->file('photo_signature') && $request->received_by) {
                $file_ktp = $request->file('photo_ktp');
                $file_signature = $request->file('photo_signature');


                $t = microtime(true);
                $micro = sprintf("%06d", ($t - floor($t)) * 1000000);
                $timestamp = date('YmdHis' . $micro, $t) . "_" . rand(0, 1000);

                $data_img_ktp = $file_ktp;
                $ext_file_ktp = $data_img_ktp->getClientOriginalExtension();
                $name_file_ktp = "" . uniqid() . '_img_item_rejected.' . $ext_file_ktp;
                $path_file_ktp = public_path() . '/image/shipment/ktp';

                $data_img_signature = $file_signature;
                $ext_file_signature = $data_img_signature->getClientOriginalExtension();
                $name_file_signature = "" . uniqid() . '_img_item_rejected.' . $ext_file_signature;
                $path_file_signature = public_path() . '/image/shipment/signature';

                if($data_img_ktp->move($path_file_ktp,$name_file_ktp)) {
                    $shipment->photo_ktp = URL::to('/image/shipment/ktp/' . $name_file_ktp);
                }

                if($data_img_signature->move($path_file_signature,$name_file_signature)) {
                    $shipment->photo_signature = URL::to('/image/shipment/signature/' . $name_file_signature);
                }
                $shipment->received_by = $request->received_by;
                $shipment->id_shipment_status = -3;
                $shipment->save();
                $data = array(
                    'err' => null,
                    'result' => "Shipment Rejected"
                );
            } else {
                $data = array(
                    'err' => [
                        'code' => 400,
                        'message' => 'Received By, Foto KTP, dan Foto Signature tidak boleh kosong'
                    ],
                    'result' => null
                );
            }
        }

        return response()->json($data, 200);
    }

    public function submitRejectedDelivery() {

    }

}
