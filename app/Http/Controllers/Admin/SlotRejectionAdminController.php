<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AirportList;
use App\MemberList;
use App\SlotList;
use App\ShipmentStatus;
use App\Shipment;
use App\AirportcityList;
use Validator;
use App\DeliveryStatus;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\User;
use App\OfficeList;

class SlotRejectionAdminController extends Controller
{
    public function index()
    {
        $flag = false;
        $shipments = Shipment::where('id_shipment_status', 7)->pluck('id_slot');
        $shipments2 = Shipment::where('id_shipment_status', 9)->pluck('id_slot');
        $data1 = SlotList::where('id_slot_status', 3)->whereIn('id', $shipments);
        $data2 = SlotList::where('id_slot_status', 5)->whereIn('id', $shipments2);
        $data3 = SlotList::withTrashed()->where('id_slot_status', -1);
        $user = User::find(Auth::id());
        if ($user->id_office != null  && $user->id != 1) {
            $office = OfficeList::find($user->id_office);
            $data1 = $data1->where('id_origin_city', $office->id_area);
            $data2 = $data2->where('id_origin_city', $office->id_area);
            $data3 = $data3->where('id_origin_city', $office->id_area);
        }

        if (Input::get('date')) {
            $data['date'] = Input::get('date');
        } else {
            $data['date'] = Carbon::now()->toDateString();
        }

        $data1 = $data1->where('depature', 'LIKE', $data['date'].'%');
        $data2 = $data2->where('depature', 'LIKE', $data['date'].'%');
        $data3 = $data3->where('depature', 'LIKE', $data['date'].'%');
        if (Input::get('param') == 'blank' || !Input::get('param') ) {
            $data['param'] = Input::get('param');
            $data['value'] = Input::get('value');
        } else {
            $data['param'] = Input::get('param');
            $data['value'] = Input::get('value');
            $flag = true;
        }

        if ($flag == true) {
            if (Input::get('param') == 'name') {
                $name = Input::get('value').'%';
                $data1 = $data1->where('first_name', 'like', $name)->get();
                $data2 = $data2->where('first_name', 'like', $name)->get();
                $data3 = $data3->where('first_name', 'like', $name)->get();
            }    
        } else {
            $data1 = $data1->get();
            $data2 = $data2->get();
            $data3 = $data3->get();
        }
        $datamerge = $data1->merge($data2);
        $data['datas'] = $data3->merge($datamerge);
        foreach($data['datas'] as $dat) {
            $dat['destination_airport'] = AirportList::find($dat->id_destination_airport)->name;
            $dat['origin_airport'] = AirportList::find($dat->id_origin_airport)->name;
        }

        return view('admin.slotrejection.index', $data);
    }
    
    public function show($id)
    {
        //
        $slot = SlotList::withTrashed()->find($id);
        $data['data'] = $slot;
        $data['data']['origin_airport'] = AirportList::find($slot->id_origin_airport)->name;
        $data['data']['destination_airport'] = AirportList::find($slot->id_destination_airport)->name;
        $member = MemberList::find($slot->id_member);
        $data['member'] = $member;
        if(Input::get('ajax') == 1) {
            $ret_data = array();
            $ret_data['origin'] = $data['data']['origin_airport'];
            $ret_data['destination'] = $data['data']['destination_airport'];
            $ret_data['shipments'] = Shipment::where('id_slot', $id)->get(['shipment_id', 'transaction_date', 'id_origin_city', 'id_destination_city', 'real_weight']);
            $ret_data['total_weight'] = 0;
            $user = User::find(Auth::id());
            $ret_data['office'] = OfficeList::find($user->id_office);
            foreach ($ret_data['shipments'] as $dat) {
                $dat['origin'] = AirportcityList::find($dat['id_origin_city'])->name;
                $dat['destination'] = AirportcityList::find($dat['id_destination_city'])->name;
                $ret_data['total_weight'] = $ret_data['total_weight'] + $dat['real_weight'];
            }
            return json_encode($ret_data);   
        }
        $data['shipments'] = Shipment::where('id_slot', $slot->id)->get();
        return view('admin.slotrejection.show', $data);
    }

    public function update($id)
    {
        $slot = SlotList::find($id);

        $slot->id_slot_status = -1;
        // $slot->deleted_at = date('Y-m-d H:m:s');
        $slot->deleted_at = Carbon::now()->todatetimeString();

        $slot->save();

        $shipments = Shipment::where('id_slot', $id)->get();

        foreach ($shipments as $shipment) {
            $shipment->id_slot = null;
            $shipment->id_shipment_status = 4;
            $shipment->is_matched = 0;
            $shipment->save();
        }

        return Redirect::to(route('slotrejection.index'));
    }
}
