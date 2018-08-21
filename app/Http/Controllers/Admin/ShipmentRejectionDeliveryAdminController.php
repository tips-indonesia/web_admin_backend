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
use App\AirportcityList;
use App\User;
use Validator;
use Auth;
use App\OfficeList;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use App\ArrivalShipment;
use App\ArrivalShipmentDetail;

class ShipmentRejectionDeliveryAdminController extends Controller
{
    public function index() {
    	$package = null;
    	$flag = false;

        if (Input::get('date')) {
            $data['date'] = Input::get('date');
        } else {
            $data['date'] = Carbon::now()->toDateString();
        }

        // $deliveries = ArrivalShipment::where('received_by_pc_date', $data['date'])
        //                              ->where('is_received_by_pc', 1)->pluck('id');
        // $packagingId = ArrivalShipmentDetail::whereIn('arrival_shipment_id', $deliveries)->pluck('packaging_lists_id');
        
        // $slotId = PackagingList::whereIn('id', $packagingId)->pluck('id_slot');
        $shipments = Shipment::whereDate('updated_at', $data['date'])->withTrashed();
        if (Input::get('param') == 'blank' || !Input::get('param')) {
            $data['param'] = Input::get('param');
            $data['value'] = Input::get('value');

        } else {
            $data['param'] = Input::get('param');
            $data['value'] = Input::get('value');
            $flag = true;
        }
        if (!isset($_GET['radio']))
            $checked = 0;
        else 
            $checked = Input::get('radio');

        
        $datas2 = Shipment::whereDate('updated_at', $data['date'])->whereIn('id_shipment_status', [-1, -2])->get();
        
        if ($flag == true) {
        	$shipments = $shipments->whereIn('id_shipment_status', [-1, -2])
                                 ->where(Input::get('param'), Input::get('value'));       			
        } else {
        	$shipments = $shipments->whereIn('id_shipment_status', [-1, -2]);
        }
        $user = User::find(Auth::id());
        if ($user->id_office != null  && $user->id != 1) {
            $office = OfficeList::find($user->id_office);
            $shipments = $shipments->where('id_destination_city', $office->id_area);
        }

        $shipments = $shipments->paginate(10);
        foreach($shipments as $shipment) {
            $shipment['is_included'] = true;
            if ($shipment->delivered_by != null) {
                if ($checked != 1) $shipment['is_included'] = false;
            } else if ($shipment->delivered_by == null) {
                if ($checked != 0) $shipment['is_included'] = false;
            }
            if ($shipment->delivered_by != null) {
                $user = User::find($shipment->delivered_by);
                $shipment['nama_pengirim'] = $user->first_name.' '.$user->last_name;
            } else {
                $shipment['nama_pengirim'] = null;
            }
        }

        $data['checked'] = $checked;
    	$data['shipments'] = $shipments;
        $data['datas2'] = $datas2;
    	return view('admin.shipmentrejectiondelivery.index', $data);
    }

    public function show($id) {
    	$shipment = Shipment::where('id', $id)->withTrashed()->first();

		if ($shipment->id_origin_city == null) $shipment['origin_city'] = null;
		else $shipment['origin_city'] = AirportcityList::find($shipment->id_origin_city)->name;

		if ($shipment->id_destination_city == null) $shipment['destination_city'] = null;
		else $shipment['destination_city'] = AirportcityList::find($shipment->id_destination_city)->name;

		if ($shipment->id_payment_type == null) $shipment['payment_type'] = null;
		else $shipment['payment_type'] = PaymentType::find($shipment->id_payment_type)->name;
		
		if ($shipment->id_bank == null) $shipment['bank_name'] = null;
		else $shipment['bank_name'] = BankList::find($shipment->id_bank)->name;

        $data['users'] = User::where('is_worker', 1)
                             ->where('id_office',User::find(Auth::id())->id_office)
                             ->get();;

    	$data['shipment'] = $shipment;
    	return view('admin.shipmentrejectiondelivery.show', $data);
    }

    public function update($id) {
        $rule = [
            'delivered_by' => "required",
            'delivered_date' => "required",
            'delivered_time' => "required"
        ];

        $messages = [
            'required' => 'This field is required.',
        ];

        $validator = Validator::make(Input::all(), $rule, $messages);

        if ($validator->fails()) {
            return $this->show($id)->withErrors($validator);
        } else {
        	if (Input::get('submit') == 'save') {
                $shipment = Shipment::withTrashed()->find($id);

                $shipment->delivered_by = Input::get('delivered_by');
                $shipment->delivered_date = Input::get('delivered_date');
                $shipment->delivered_time = Input::get('delivered_time');

                $shipment->save();
            } else if (Input::get('submit') == 'submit') {
                $shipment = Shipment::withTrashed()->find($id);

                $shipment->id_shipment_status = -2;

                $shipment->save();

                return redirect(route('shipmentrejectiondelivery.index'));
            }   

        	return back();
        }
    }
}
