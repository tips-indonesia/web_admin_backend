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

        $packages = PackagingList::join('shipments', 'shipments.id_slot', '=', 'packaging_lists.id_slot')
              ->select(
                  'packaging_lists.*',
                  'shipments.id_shipment_status'
                );

        $user = User::find(Auth::id());

        if ($user->id_office != null  && $user->id != 1) {
            $office = OfficeList::find($user->id_office);
            $slot = SlotList::where('id_destination_city', $office->id_area)->pluck('id');
            $packages = $packages->whereIn('packaging_lists.id_slot', $slot);
        }

        if (Input::get('date')) {
            $data['date'] = Input::get('date');
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
              ->where(Input::get('param'), Input::get('value'))
              ->distinct();		
        } else {
        	$packages = $packages
                  ->distinct();
        }
        
        $packages = $packages->pluck('id');
        $deliveries = ArrivalShipment::whereIn('id', ArrivalShipmentDetail::whereIn('packaging_lists_id', $packages)->pluck('arrival_shipment_id'))->get();
        foreach($deliveries as $delivery) {
            // $detilarrivalshipment = ArrivalShipmentDetail::
            //           where('packaging_lists_id', $delivery->id)->first();
            // $dumm = ArrivalShipment::find($detilarrivalshipment->arrival_shipment_id);

            // $delivery['delivery_id'] = $dumm->delivery_id;
            // $delivery['delivery_date'] = $dumm->delivery_date;
            $delivery['is_included'] = true;
            if ($delivery['delivery_date'] != $data['date']) {
                $delivery['is_included'] = false;
            }

            if ($delivery->is_received_by_pc == 0 && $checked != 0 && $checked != -1) $delivery['is_included'] = false;

            if ($delivery->is_received_by_pc == 1 && $checked != 1 && $checked != -1) $delivery['is_included'] = false;

            $delivery['total_shipment'] = Shipment::where('id_slot', $delivery->id_slot)->count();
            // $delivery['is_received_by_pc'] = $dumm->is_received_by_pc;
            // $delivery['received_by_pc_date'] = $dumm->received_by_pc_date;
        }

    	$data['deliveries'] = $deliveries;
        $data['checked'] = $checked;
    	return view('admin.receivedarrivalprocessingcenter.index', $data);
    }

    public function update($id) {
    	// if (Input::get('submit') =='post') {
            $delivery = ArrivalShipment::find($id);

            $delivery->is_received_by_pc = 1;
            $delivery->received_by_pc_date = Carbon::now()->toDateString();

            $delivery->save();

            $packages_id = ArrivalShipmentDetail::where('arrival_shipment_id', $delivery->id)
                                                ->pluck('packaging_lists_id');
            $package = PackagingList::whereIn('id', $packages_id)->pluck('id_slot');
            
            // SHIPMENT
      		$shipments = Shipment::whereIn('id_slot', $package)->get();
      		
      		foreach ($shipments as $shipment) {
      			$shipment->id_shipment_status = 12;
      			$shipment->save();
      		}

        return redirect(route('receivedarrivalprocessingcenter.index'));
    }

    public function show($id) {
        $delivery = ArrivalShipment::find($id);
        $package = PackagingList::whereIn('id', ArrivalShipmentDetail::where('arrival_shipment_id', $id)->pluck('packaging_lists_id'))->get();

        foreach ($package as $pack) {
          $pack['shipments'] = Shipment::where('id_slot', $pack->id_slot)->get();  
          foreach ($pack['shipments'] as $shipment) {
            $shipment['origin_city'] = AirportcityList::find($shipment->id_origin_city)->name;
            $shipment['destination_city'] = AirportcityList::find($shipment->id_destination_city)->name;
          }
        }
        
        
        $data['delivery'] = $delivery;
        $data['packages'] = $package;
        return view('admin.receivedarrivalprocessingcenter.show', $data);
    }  
}
