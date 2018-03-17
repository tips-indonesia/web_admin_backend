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
        if (!isset($_GET['radio']))
            $checked = -1;
        else 
            $checked = Input::get('radio');

        if ($flag == true) {
        	$shipments = Shipment::whereIn('id_shipment_status', [12,14,15])
                                 ->where(Input::get('param'), Input::get('value'))
                                 ->get();       			
        } else {
        	$shipments = Shipment::whereIn('id_shipment_status', [12,14,15])
                                 ->get();
        }

        foreach($shipments as $shipment) {
            if ($shipment->delivered_by != null) {
                $user = User::find($shipment->delivered_by);
                $shipment['nama_pengirim'] = $user->first_name.' '.$user->last_name;
            } else {
                $shipment['nama_pengirim'] = null;
            }
        }

        $data['checked'] = $checked;
    	$data['shipments'] = $shipments;

    	return view('admin.deliveryshipment.index', $data);
    }

    public function show($id) {
    	$shipment = Shipment::find($id);

		if ($shipment->id_origin_city == null) $shipment['origin_city'] = null;
		else $shipment['origin_city'] = AirportcityList::find($shipment->id_origin_city)->name;

		if ($shipment->id_destination_city == null) $shipment['destination_city'] = null;
		else $shipment['destination_city'] = AirportcityList::find($shipment->id_destination_city)->name;

		if ($shipment->id_shipment_status == null) $shipment['shipment_status'] = null;
		else $shipment['shipment_status'] = ShipmentStatus::find($shipment->id_shipment_status)->description;

		if ($shipment->id_payment_type == null) $shipment['payment_type'] = null;
		else $shipment['payment_type'] = PaymentType::find($shipment->id_payment_type)->name;
		
		if ($shipment->id_bank == null) $shipment['bank_name'] = null;
		else $shipment['bank_name'] = BankList::find($shipment->id_bank)->name;

        $data['users'] = User::all();

    	$data['shipment'] = $shipment;
    	return view('admin.deliveryshipment.show', $data);
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
                $shipment = Shipment::find($id);

                $shipment->delivered_by = Input::get('delivered_by');
                $shipment->delivered_date = Input::get('delivered_date');
                $shipment->delivered_time = Input::get('delivered_time');

                $shipment->save();
            } else if (Input::get('submit') == 'submit') {
                $shipment = Shipment::find($id);

                $shipment->id_shipment_status = 14;

                $shipment->save();

                return redirect(route('deliveryshipment.index'));
            }   

        	return back();
        }
    }
}
