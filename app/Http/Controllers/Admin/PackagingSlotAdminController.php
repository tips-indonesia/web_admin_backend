<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PackagingList;
use App\SlotList;
use App\Shipment;
use App\AirportList;
use Validator;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class PackagingSlotAdminController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
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
            $data['datas'] = $data['datas']->where(Input::get('param'),'=', Input::get('value'));
        }
        $data['datas'] = $data['datas']->where('id_slot', '!=',null)->paginate(10);
        foreach ($data['datas'] as $dat) {
            if ($dat->id_slot != null)
                $dat['slot_id'] = SlotList::find($dat->id_slot)->slot_id;
        }

        $data['datas2'] = SlotList::whereNotIn('id', PackagingList::where('id_slot', '!=',null)->where('status_dispatch', 'Process')->pluck('id_slot')->toArray())->get();
        foreach ($data['datas2'] as $dat) {
            $dat['weight'] = Shipment::where('id_slot', $dat->id)->first()->estimate_weight;
            $dat['origin'] = AirportList::find($dat->id_origin_airport)->name;
            $dat['destination'] = AirportList::find($dat->id_destination_airport)->name;
        }
        return view('admin.packagingslots.index', $data);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function create()
    {
        $pl = new PackagingList;
        $pl->packaging_id = '2017';
        $pl->save();
        $pl->packaging_id =  $pl->id.'2017';
        $pl->save();
        return Redirect::to(route('packagingslots.edit', $pl->id));
        
    }

    /**
    * Store a newly created resource in storage.
    *
    * @return Response
    */
    public function store()
    {
        //
        // $rules = array(
        //     'name' => 'required',
        //     'birth_date' => 'required',
        //     'address' => 'required',
        //     'phone_no' => 'required',
        //     'email_address' => 'required',
        //     'city' => 'required',
        //     'password' => 'required|min:6|confirmed',
        // );
        // $validator = Validator::make(Input::all(), $rules);

        // // process the login
        // if ($validator->fails()) {
        //     return Redirect::to(route('memberlists.create'))
        //         ->withErrors($validator)
        //         ->withInput();
        // } else {
        //     $member = new MemberList;
        //     $member->name = Input::get('name');
        //     $member->birth_date = Input::get('birth_date');
        //     $member->registered_date = \Carbon\Carbon::now();
        //     $member->password = bcrypt(Input::get('password'));
        //     $member->address = Input::get('address');
        //     $member->mobile_phone_no = Input::get('phone_no');
        //     $member->email = Input::get('email_address');
        //     $member->id_city = Input::get('city');
        //     $member->save();
        //     Session::flash('message', 'Successfully created nerd!');
        //     return Redirect::to(route('memberlists.index'));
        // }
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
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
    public function edit($id)
    {
        //
        $data['data'] = PackagingList::find($id);
        $data['slot_ids'] = SlotList::where('status_dispatch', 'Process')->get();
        return view('admin.packagingslots.edit', $data);

    }

    /**
    * Update the specified resource in storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function update($id)
    {
        //
        $rules = array(
            'slot' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        $changepass = false;
        if ($validator->fails()) {
            return Redirect::to(route('packagingslots.edit', $id))
                ->withErrors($validator)
                ->withInput();
        } else {
            $packagingslots = PackagingList::find($id);
            $packagingslots->id_slot = Input::get('slot');
            $packagingslots->save();
            Session::flash('message', 'Successfully created nerd!');
            return Redirect::to(route('packagingslots.index'));
        }
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function destroy($id)
    {
        //
        $member = PackagingList::find($id);
        $member->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the nerd!');
        return Redirect::to(route('packagingslots.index'));
    }
}
