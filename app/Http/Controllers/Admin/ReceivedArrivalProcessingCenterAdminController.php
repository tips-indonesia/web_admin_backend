<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PackagingList;
use App\SlotList;
use App\Shipment;
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

        if ($flag == true) {
        	if (Input::get('param') == 'received') {
				$package = PackagingList::join('slot_lists', 'packaging_lists.id_slot', '=', 'slot_lists.id')
	    							->join('shipments', 'shipments.id_slot', '=', 'slot_lists.id')
	    						    ->select('packaging_lists.*', 'slot_lists.id_slot_status', 'slot_lists.slot_id', 'shipments.id_shipment_status')
	    						    ->where('slot_lists.id_slot_status', '>=', '6')
	    						    ->where('shipments.id_shipment_status', '>=', '12')
	    						    ->distinct()
	    						    ->get();        	
	        } else if (Input::get('param') == 'not_received') {
				$package = PackagingList::join('slot_lists', 'packaging_lists.id_slot', '=', 'slot_lists.id')
	    							->join('shipments', 'shipments.id_slot', '=', 'slot_lists.id')
	    						    ->select('packaging_lists.*', 'slot_lists.id_slot_status', 'slot_lists.slot_id', 'shipments.id_shipment_status')
	    						    ->where('slot_lists.id_slot_status', '>=', '6')
	    						    ->where('shipments.id_shipment_status', '<', '11')
	    						    ->distinct()
	    						    ->get();        	
	        } else {
	        	$package = PackagingList::join('slot_lists', 'packaging_lists.id_slot', '=', 'slot_lists.id')
	    							->join('shipments', 'shipments.id_slot', '=', 'slot_lists.id')
	    						    ->select('packaging_lists.*', 'slot_lists.id_slot_status', 'slot_lists.slot_id', 'shipments.id_shipment_status')
	    						    ->where('slot_lists.id_slot_status', '>=', '6')
	    						    ->where(Input::get('param'), Input::get('value'))
	    						    ->distinct()
	    						    ->get();        			
			}
        } else {
        	$package = PackagingList::join('slot_lists', 'packaging_lists.id_slot', '=', 'slot_lists.id')
    							->join('shipments', 'shipments.id_slot', '=', 'slot_lists.id')
    						    ->select('packaging_lists.*', 'slot_lists.id_slot_status', 'slot_lists.slot_id', 'shipments.id_shipment_status')
    						    ->where('slot_lists.id_slot_status', '>=', '6')
    						    ->distinct()
    						    ->paginate(10);
        }

    	$data['packages'] = $package;

    	return view('admin.receivedarrivalprocessingcenter.index', $data);
    }

    public function update($id) {
    	// if (Input::get('submit') =='post') {
    		$packages = PackagingList::find($id);
			$slots = SlotList::find($packages->id_slot);
			$slots->id_slot_status = 7;
			$slots->save();
            // SHIPMENT
      		$shipments = Shipment::where('id_slot', $slots->id)->get();
      		
      		foreach ($shipments as $shipment) {
      			$shipment->id_shipment_status = 12;
      			$shipment->save();
      		}

        return back();
    }
}
