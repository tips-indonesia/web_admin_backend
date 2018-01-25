<?php

namespace App\Http\Controllers\API\Worker;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Shipment;
use App\ShipmentStatus;
use App\AirportcityList;

class ShipmentController extends Controller
{
    //
    function get_detail(Request $request) {

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
            $shipment->estimate_weight = $request->estimate_weight;
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


}
