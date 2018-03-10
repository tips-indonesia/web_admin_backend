<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PackagingList;
use App\SlotList;
use App\Shipment;
use App\ShipmentStatus;
use App\CityList;
use App\PaymentType;
use App\BankList;
use Illuminate\Support\Facades\Input;

class DeliveryShipmentAdminController extends Controller
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

        if ($flag == true) {
        	$package = PackagingList::join('slot_lists', 'packaging_lists.id_slot', '=', 'slot_lists.id')
    							->join('shipments', 'shipments.id_slot', '=', 'slot_lists.id')
    						    ->select('packaging_lists.*', 
                                         'slot_lists.id_slot_status', 
                                         'slot_lists.slot_id', 
                                         'shipments.id_shipment_status', 
                                         'slot_lists.origin_city',
                                         'slot_lists.destination_city')
    						    ->where('slot_lists.id_slot_status', '7')
    						    ->where(Input::get('param'), Input::get('value'))
    						    ->distinct()
    						    ->get();        			
        } else {
        	$package = PackagingList::join('slot_lists', 'packaging_lists.id_slot', '=', 'slot_lists.id')
    							->join('shipments', 'shipments.id_slot', '=', 'slot_lists.id')
    						    ->select('packaging_lists.*', 
                                             'slot_lists.id_slot_status', 
                                             'slot_lists.slot_id', 
                                             'shipments.id_shipment_status', 
                                             'slot_lists.origin_city',
                                             'slot_lists.destination_city')
    						    ->where('slot_lists.id_slot_status', '7')
    						    ->distinct()
    						    ->paginate(10);
        }

    	$data['packages'] = $package;

    	return view('admin.deliveryshipment.index', $data);
    }

    public function show($id) {
    	$package = PackagingList::find($id);
    	$shipments = Shipment::where('id_slot', $package->id_slot)->get();

    	foreach ($shipments as $shipment) {
    		if ($shipment->id_origin_city == null) $shipment['origin_city'] = null;
    		else $shipment['origin_city'] = CityList::find($shipment->id_origin_city)->name;

    		if ($shipment->id_destination_city == null) $shipment['destination_city'] = null;
    		else $shipment['destination_city'] = CityList::find($shipment->id_destination_city)->name;

    		if ($shipment->id_shipment_status == null) $shipment['shipment_status'] = null;
    		else $shipment['shipment_status'] = ShipmentStatus::find($shipment->id_shipment_status)->description;

    		if ($shipment->id_payment_type == null) $shipment['payment_type'] = null;
    		else $shipment['payment_type'] = PaymentType::find($shipment->id_payment_type)->name;
    		
    		if ($shipment->id_bank == null) $shipment['bank_name'] = null;
    		else $shipment['bank_name'] = BankList::find($shipment->id_bank)->name;
    	}
    	$data['shipments'] = $shipments;
    	return view('admin.deliveryshipment.show', $data);
    }

    public function update($id) {
    	$package = PackagingList::find($id);

    	$package->is_open = 1;

    	$package->save();

    	return back();
    }
}
