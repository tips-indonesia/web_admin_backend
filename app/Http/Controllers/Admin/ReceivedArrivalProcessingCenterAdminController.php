<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PackagingList;
use App\SlotList;
use App\Shipment;
use App\CityList;
use App\AirportcityList;
use App\ArrivalShipment;
use App\ArrivalShipmentDetail;
use Illuminate\Support\Facades\Input;

class ReceivedArrivalProcessingCenterAdminController extends Controller
{
    public function index() {
    	$package = null;
    	$flag = false;
        if (Input::get('param') == 'blank' || !Input::get('param')) {
            $data['param'] = Input::get('param');
            $data['value'] = Input::get('value');

        } else {
            $data['param'] = Input::get('param');
            $data['value'] = Input::get('value');
            $flag = true;
        }
        if (!isset($_GET['radio']))
            $checked = -1;
        else 
            $checked = Input::get('radio');

        if ($flag == true) {
        	$deliveries = ArrivalShipmentDetail::
                join('packaging_lists', 
                     'delivery_to_arrival_processing_center_detil.packaging_lists_id',
                     '=', 
                     'packaging_lists.id')
              ->join('delivery_to_arrival_processing_center',
                     'delivery_to_arrival_processing_center.id',
                     '=',
                     'delivery_to_arrival_processing_center_detil.arrival_shipment_id')
              ->join('shipments', 'shipments.id_slot', '=', 'packaging_lists.id_slot')
              ->select('delivery_to_arrival_processing_center_detil.*',
                       'packaging_lists.*',
                       'shipments.id_shipment_status',
                       'delivery_to_arrival_processing_center.delivery_id',
                       'delivery_to_arrival_processing_center.is_received_by_pc')
              ->where('shipments.id_shipment_status', '>=', '11')
              ->where(Input::get('param'), Input::get('value'))
              ->distinct()
              ->get();       			
        } else {
        	$deliveries = ArrivalShipmentDetail::
                    join('packaging_lists', 
                         'delivery_to_arrival_processing_center_detil.packaging_lists_id',
                         '=', 
                         'packaging_lists.id')
                  ->join('delivery_to_arrival_processing_center',
                         'delivery_to_arrival_processing_center.id',
                         '=',
                         'delivery_to_arrival_processing_center_detil.arrival_shipment_id')
                  ->join('shipments', 'shipments.id_slot', '=', 'packaging_lists.id_slot')
                  ->select('delivery_to_arrival_processing_center_detil.*',
                           'packaging_lists.*',
                           'shipments.id_shipment_status',
                           'delivery_to_arrival_processing_center.is_received_by_pc')
                  ->where('shipments.id_shipment_status', '>=', '11')
                  ->distinct()
                  ->get();    
        }

        foreach($deliveries as $delivery) {
            $dumm = ArrivalShipment::find($delivery->arrival_shipment_id);
            $delivery['delivery_id'] = $dumm->delivery_id;
            $delivery['delivery_date'] = $dumm->delivery_date;
            $delivery['total_shipment'] = Shipment::where('id_slot', $delivery->id_slot)->count();
            $delivery['is_received_by_pc'] = $dumm->is_received_by_pc;
            $delivery['received_by_pc_date'] = $dumm->received_by_pc_date;
        }

    	$data['deliveries'] = $deliveries;
        $data['checked'] = $checked;
    	return view('admin.receivedarrivalprocessingcenter.index', $data);
    }

    public function update($id) {
    	// if (Input::get('submit') =='post') {
            $delivery = ArrivalShipment::find($id);

            $delivery->is_received_by_pc = 1;
            $delivery->received_by_pc_date = date('Y-m-d');

            $delivery->save();

            $packages_id = ArrivalShipmentDetail::where('arrival_shipment_id', $delivery->id)
                                                ->first()
                                                ->packaging_lists_id;

    		  $packages = PackagingList::find($packages_id);
			    $slots = SlotList::find($packages->id_slot);
          $slots->id_slot_status = 7; 
          $slots->save();
            // SHIPMENT
      		$shipments = Shipment::where('id_slot', $slots->id)->get();
      		
      		foreach ($shipments as $shipment) {
      			$shipment->id_shipment_status = 12;
      			$shipment->save();
      		}

        return redirect(route('receivedarrivalprocessingcenter.index'));
    }

    public function show($id) {
        $delivery = ArrivalShipment::find($id);
        $package_id = ArrivalShipmentDetail::where('arrival_shipment_id', $id)
                                           ->first()
                                           ->packaging_lists_id;
        $package = PackagingList::find($package_id);
        $shipments = Shipment::where('id_slot', $package->id_slot)->get();
        foreach ($shipments as $shipment) {
            $shipment['origin_city'] = AirportcityList::find($shipment->id_origin_city)->name;
            $shipment['destination_city'] = AirportcityList::find($shipment->id_destination_city)->name;
        }
        $data['delivery'] = $delivery;
        $data['shipments'] = $shipments;
        return view('admin.receivedarrivalprocessingcenter.show', $data);
    }  
}
