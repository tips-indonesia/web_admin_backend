<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AirportList;
use App\MemberList;
use App\SlotList;
use App\ShipmentStatus;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class SlotListAdminController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
        $data['datas'] = SlotList::paginate(10);
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
        return view('admin.slotlists.show');
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
