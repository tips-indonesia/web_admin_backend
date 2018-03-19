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
use Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\User;
use App\OfficeList;

class SlotListAdminController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
        $data['datas'] = SlotList::where('status_dispatch', 'Process');
        $user = User::find(Auth::id());
        if ($user->id_office != null) {
            $office = OfficeList::find($user->id_office);
            $data['datas'] = $data['datas']->where('id_origin_city', $office->id_area);
        }

        $data['datas'] = $data['datas']->paginate(10);
        foreach($data['datas'] as $dat) {
            $dat['member_name'] = MemberList::find($dat->id_member)->name;
            $dat['destination_airport'] = AirportList::find($dat->id_destination_airport)->name;
            $dat['origin_airport'] = AirportList::find($dat->id_origin_airport)->name;
        }
        return view('admin.slotlists.index', $data);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function create()
    {
    }

    /**
    * Store a newly created resource in storage.
    *
    * @return Response
    */
    public function store()
    {
       

    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
    public function show($id)
    {
        //
        $slot = SlotList::find($id);
        $data['data'] = $slot;
        $data['data']['origin_airport'] = AirportList::find($slot->id_origin_airport)->name;
        $data['data']['destination_airport'] = AirportList::find($slot->id_destination_airport)->name;
        $member = MemberList::find($slot->id_member);
        $data['data']['member'] = $member;
        if(Input::get('ajax') == 1) {
            $ret_data = array();
            $ret_data['origin'] = $data['data']['origin_airport'];
            $ret_data['destination'] = $data['data']['destination_airport'];
            $ret_data['shipments'] = Shipment::where('id_slot', $id)->get(['shipment_id', 'transaction_date', 'id_origin_city', 'id_destination_city', 'estimate_weight']);
            $ret_data['total_weight'] = 0;
            foreach ($ret_data['shipments'] as $dat) {
                $dat['origin'] = AirportcityList::find($dat['id_origin_city'])->name;
                $dat['destination'] = AirportcityList::find($dat['id_destination_city'])->name;
                $ret_data['total_weight'] = $ret_data['total_weight'] + $dat['estimate_weight'];
            }
            return json_encode($ret_data);   
        }        
        return view('admin.slotlists.show', $data);
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
    public function edit($id)
    {
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function update($id)
    {
        
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function destroy($id)
    {
    }
}
