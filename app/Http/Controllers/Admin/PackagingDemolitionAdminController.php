<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PackagingList;
use App\SlotList;
use App\Shipment;
use App\AirportList;
use App\User;
use App\OfficeList;
use App\AirportcityList;
use Auth;
use Validator;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class PackagingDemolitionAdminController extends Controller
{
    public function index() {
        //
        if (Input::get('date')) {
            $data['datas'] = PackagingList::whereDate('created_at', Input::get('date'));
            $data['date'] = Input::get('date');
        } else {
            $data['date'] = Carbon::now()->toDateString();
            $data['datas'] = PackagingList::whereDate('created_at', $data['date']);
        }
        if (Input::get('param') == 'blank' || !Input::get('param') ) {
            $data['datas'] = $data['datas']->where('id', '!=', null);
            $data['param'] = Input::get('param');
            $data['value'] = Input::get('value');
        } else {
            $data['param'] = Input::get('param');
            $data['value'] = Input::get('value');
            if ($data['param'] == 'slot_id') {
                $slot = SlotList::withTrashed()->where('slot_id', Input::get('value'))->first();
                if ($slot == null) {
                    $data['data'] = $data['datas']->where('id_slot', null);
                } else {
                    $data['data'] = $data['datas']->where('id_slot', $slot->id);
                }
                
            } else {
                $data['datas'] = $data['datas']->where(Input::get('param'),'=', Input::get('value'));

            }
            
        }
        $user = User::find(Auth::id());
        if ($user->id_office != null  && $user->id != 1) {
            $office = OfficeList::find($user->id_office);
            $slot = SlotList::withTrashed()->where('id_origin_city', $office->id_area)->pluck('id');
            $data['datas'] = $data['datas']->whereIn('id_slot', $slot);
        }

        $data['datas'] = $data['datas']->where('id_slot', '!=',null)->paginate(10);

        foreach ($data['datas'] as $dat) {
            if ($dat->id_slot != null)
                $dat['slot'] = SlotList::withTrashed()->find($dat->id_slot);
        }

        $data['datas2'] = SlotList::withTrashed()->whereNotIn('id', PackagingList::where('id_slot', '!=',null)->pluck('id_slot')->toArray())->where('status_dispatch', 'Process')->where('id_slot_status', 3);

        
        if ($user->id_office != null && $user->id != 1) {
            $office = OfficeList::find($user->id_office);
            $data['datas2'] = $data['datas2']->where('id_origin_city', $office->id_area)->get();
        } else {
            $data['datas2'] = $data['datas2']->get();
        }

        $o = 0;
        foreach ($data['datas2'] as $dat) {
            // if($o == 1)
            //     dd(json_encode($dat), Shipment::where('id_slot', $dat->id));
            if (Shipment::where('id_slot', $dat->id)->first() != null)
                $dat['weight'] = Shipment::where('id_slot', $dat->id)->first()->estimate_weight;
            else $dat['weight'] = null;
            $dat['origin'] = AirportList::find($dat->id_origin_airport)->name;
            $dat['destination'] = AirportList::find($dat->id_destination_airport)->name;
            $o++;
        }
        return view('admin.packagingdemolition.index', $data);
    }

    public function edit($id)
    {
        //
        $data['data'] = PackagingList::find($id);
        $user = User::find(Auth::id());
        $data['office'] = OfficeList::find($user->id_office);
        $packId = PackagingList::where('id_slot', '==',null)->pluck('id_slot');
        $data['slot_ids'] = SlotList::withTrashed()->where('id', $data['data']->id_slot)->where('status_dispatch', 'Process')->whereNotIn('id', $packId)->get()->union(SlotList::find($data['data']));
        // foreach ($data['slot_ids'] as $a) {
        //     echo $a.'<br />';
        // }
        $data['origin'] = $data['slot_ids'][0]->origin_city;
        $data['destination'] = $data['slot_ids'][0]->destination_city;
        $ret_data = array();
        $ret_data['shipments'] = Shipment::withTrashed()->where('id_slot', $data['data']->id_slot)->get(['shipment_id', 'transaction_date', 'id_origin_city', 'id_destination_city', 'real_weight', 'id', 'rejection_type', 'add_notes', 'id_shipment_status']);
        $ret_data['total_weight'] = 0;
        $user = User::find(Auth::id());
        $ret_data['office'] = OfficeList::find($user->id_office);
        foreach ($ret_data['shipments'] as $dat) {
            $dat['origin'] = AirportcityList::find($dat['id_origin_city'])->name;
            $dat['destination'] = AirportcityList::find($dat['id_destination_city'])->name;
            $ret_data['total_weight'] = $ret_data['total_weight'] + $dat['real_weight'];
        }

        $data['ret_data'] = $ret_data;
        return view('admin.packagingdemolition.edit', $data);

    }

    public function update($id) {
        $rules = [
            'additional_notes' => 'required'
        ];

        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator);
        } else {
            $shipment = Shipment::where('shipment_id', Input::get('shipment_id'))->first();

            $shipment->id_shipment_status = -1;
            $shipment->deleted_at = Carbon::now()->toDateString();
            $shipment->rejection_type = Input::get('rejection_type');
            $shipment->add_notes = Input::get('additional_notes');

            $shipment->save();

            return back();
        }
    }
}
