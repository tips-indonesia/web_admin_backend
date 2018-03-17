<?php

namespace App\Http\Controllers\API\Worker;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Shipment;
use App\ShipmentStatus;
use App\AirportcityList;
use Illuminate\Support\Facades\URL;

class ShipmentController extends Controller
{
    //
    function get_detail(Request $request) {

        $shipment_id = $request->shipment_id;
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

    function pickup(Request $request) {

        $shipment_id = $request->shipment_id;
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
            $shipment->real_weight = $request->estimate_weight;
            $shipment->status_dispatch = "Process";
            $shipment->id_shipment_status = 3;
            $shipment->save();

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

            $data = array(
                'err' => null,
                'result' => [
                    'code' => 1,
                    'message' => 'Berasil mengupload signature'
                ]
            );
        }

        return response()->json($data, 200);
    }


}
