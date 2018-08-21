<?php

namespace App\Http\Controllers\API\Worker;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\DeliveryShipment;
use App\DeliveryShipmentDetail;
use App\Shipment;
use App\OfficeList;
use App\ShipmentStatus;
use App\ShipmentHistory;
use App\AirportcityList;
use App\User;
use Auth;

class RcvdController extends Controller
{
    public function allRcvd(Request $request) {
        if (!$request->id_user) {
            $data = array(
                'err' => [
                    'code' => 0,
                    'message' => 'Paramter id_user tidak boleh kosong'
                ],
                'result' => null
            );
        } else {
            $date = Carbon::now()->toDateString();
            $deliveries = DeliveryShipment::whereDate('delivery_date',  $date)
                                        ->where('is_posted', 1)
                                        ->pluck('id')
                                        ->toArray();

            $shipment_1 = DeliveryShipmentDetail::whereIn('id_delivery', $deliveries)->pluck('id_shipment')->toArray();
            $shipments_2 = Shipment::where('is_take',1)->where('is_posted', 1)->pluck('id')->toArray();
            $shipments = array_merge($shipment_1, $shipments_2);
            $shipment_data = Shipment::whereIn('id', $shipments);

            $shipment_data = $shipment_data->where('pickup_date', $date);
            $user = User::find($request->id_user);
            if ($user->id_office != null  && $user->id != 1) {
                $office = OfficeList::find($user->id_office);
                $shipment_data = $shipment_data->where('id_origin_city', $office->id_area);
            }
            $shipment_data = $shipment_data->where('id_shipment_status', '>=', 3)
                                           ->select('shipment_id', 'id_shipment_status', 'id_origin_city', 'id_destination_city')
                                           ->get();
            
            foreach($shipment_data as $ship) {
                $ship['origin'] = AirportcityList::find($ship->id_origin_city)->name;
                $ship['destination'] = AirportcityList::find($ship->id_destination_city)->name;
                $ship['status'] = ($ship->id_shipment_status == 3) ? 'Belum Diterima' : 'Sudah Diterima';
            }
            $data = array(
                'err' => null,
                'result' => $shipment_data
            );
        }   

        return response()->json($data, 200);
    }

    public function receiveShipment(Request $request) {
        if (!isset($_GET['id_shipment'])) {
            $data = array(
                'err' => [
                    'code' => 0,
                    'message' => 'Paramter id_shipment tidak boleh kosong'
                ],
                'result' => null
            );
        } else {
            $id = $_GET['id_shipment'];
            $process = Shipment::where('shipment_id')->first();
            if ($process == null) {
                $data = array(
                    'err' => [
                        'code' => 404,
                        'message' => 'Data shipment tidak ditemukan'
                    ],
                    'result' => null
                ); 
            } else {
                $process->id_shipment_status = 4;
                $process->save();
                $shipment_history = new ShipmentHistory;
                $shipment_history->id_shipment_status = 4;
                $shipment_history->id_shipment = $id;
                $shipment_history->save();
                $data = array(
                    'err' => null,
                    'result' => [
                        "messsage"=> "Shipment berhasil diterima"
                    ]
                );
            }
        }
        return response()->json($data, 200);
    }
}
