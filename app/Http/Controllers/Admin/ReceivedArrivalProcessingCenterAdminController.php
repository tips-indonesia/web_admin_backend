<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PackagingList;
use App\SlotList;
use App\Shipment;
use App\User;
use Auth;
use Carbon\Carbon;
use App\OfficeList;
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
      $flagdate = false;

        $packages = PackagingList::join('shipments', 'shipments.id_slot', '=', 'packaging_lists.id_slot')
              ->select(
                  'packaging_lists.*',
                  'shipments.id_shipment_status'
                );

        $user = User::find(Auth::id());

        if ($user->id_office != null) {
            $office = OfficeList::find($user->id_office);
            $slot = SlotList::where('id_destination_city', $office->id_area)->pluck('id');
            $packages = $packages->whereIn('packaging_lists.id_slot', $slot);
        }

        if (Input::get('date')) {
            $data['date'] = Input::get('date');
            $flagdate = true;
        } else {
            $data['date'] = Carbon::now()->toDateString();
        }

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
        	$packages = $packages
              ->where('shipments.id_shipment_status', '>=', '11')
              ->where(Input::get('param'), Input::get('value'))
              ->distinct()
              ->get();       			
        } else {
        	$packages = $packages
                  ->where('shipments.id_shipment_status', '>=', '11')
                  ->distinct()
                  ->get();    
        }
        foreach($packages as $delivery) {
            $detilarrivalshipment = ArrivalShipmentDetail::
                      where('packaging_lists_id', $delivery->id)->first();
            $dumm = ArrivalShipment::find($detilarrivalshipment->arrival_shipment_id);

            $delivery['delivery_id'] = $dumm->delivery_id;
            $delivery['delivery_date'] = $dumm->delivery_date;
            $delivery['is_included'] = true;
            if ($flagdate) {
              if ($delivery['delivery_date'] != $data['date']) {
                $delivery['is_included'] = false;
              }
            }
            $delivery['total_shipment'] = Shipment::where('id_slot', $delivery->id_slot)->count();
            $delivery['is_received_by_pc'] = $dumm->is_received_by_pc;
            $delivery['received_by_pc_date'] = $dumm->received_by_pc_date;
        }

    	$data['deliveries'] = $packages;
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
            $package = PackagingList::find($packages_id);
            
            // SHIPMENT
      		$shipments = Shipment::where('id_slot', $package->id_slot)->get();
      		
      		foreach ($shipments as $shipment) {
      			$shipment->id_shipment_status = 12;
      			$shipment->save();
      		}

        return redirect(route('receivedarrivalprocessingcenter.index'));
    }

    public function show($id) {
        $package = PackagingList::find($id);
        $delivery = ArrivalShipment::find(
          ArrivalShipmentDetail::where('packaging_lists_id', $id)
                  ->first()
                  ->arrival_shipment_id
        );

        $shipments = Shipment::where('id_slot', $package->id_slot)->get();
        foreach ($shipments as $shipment) {
            $shipment['origin_city'] = AirportcityList::find($shipment->id_origin_city)->name;
            $shipment['destination_city'] = AirportcityList::find($shipment->id_destination_city)->name;
        }
        $data['delivery'] = $delivery;
        $data['package'] = $package;
        $data['shipments'] = $shipments;
        return view('admin.receivedarrivalprocessingcenter.show', $data);
    }  
}
