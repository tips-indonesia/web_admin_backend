<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AirportCityScope;
use App\AirportList;
use App\CityList;
use App\PackagingList;
use App\SlotList;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
class PendingDepartureCounterAdminController extends Controller
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
            $data['datas'] = PackagingList::where('created_at', Input::get('date'));
            $data['date'] = Input::get('date');
        } else {
            $data['date'] = Carbon::now()->toDateString();
            $data['datas'] = PackagingList::where('created_at', $data['date']);
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
        $data['datas'] = $data['datas']->paginate(10);
        foreach ($data['datas'] as $dat) {
            if ($dat->id_slot != null)
                $slot = SlotList::find($dat->id_slot);
                $dat['slot_id'] = $slot->slot_id;
                $dat['origin_city'] = CityList::find($slot->origin_city)->name;
                $dat['destination_city'] = CityList::find($slot->destination_city)->name;
        }
        return view('admin.pendingdeparturecounters.index', $data);
        
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function create($airport)
    {
        //
    }

    /**
    * Store a newly created resource in storage.
    *
    * @return Response
    */
    public function store($airport)
    {
        //

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
    public function edit($airport, $id)
    {
        //
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function update($airport, $id)
    {
        //
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function destroy($airport,$id)
    {
        //
    }
}
