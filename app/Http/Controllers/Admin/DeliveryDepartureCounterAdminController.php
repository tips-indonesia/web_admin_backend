<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Shipment;
use App\DeliveryShipment;
use App\DeliveryShipmentDetail;
use App\ShipmentHistory;
use App\OfficeList;
use App\PackagingList;
use App\PackagingDelivery;
use App\Delivery;
use Validator;
use App\CityList;
use App\AirportcityList;
use App\SlotList;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class DeliveryDepartureCounterAdminController extends Controller
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
            $data['datas'] = DeliveryShipment::where('delivery_date', Input::get('date'));
            $data['date'] = Input::get('date');
        } else {
            $data['date'] = Carbon::now()->toDateString();
            $data['datas'] = DeliveryShipment::where('delivery_date', $data['date']);
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
            $dat['total'] = PackagingDelivery::where('deliveries_id', $dat->id)->get()->count();
        }
        $pendings = SlotList::where('status_dispatch', 'Pending')->pluck('id')->toArray();
        $data['datas2'] = PackagingList::whereIn('id_slot', $pendings)->get();
        foreach ($data['datas2'] as $dat) {
            $slot = SlotList::find($dat->id_slot);
            $dat['total'] = Shipment::where('id_packaging', $dat->id)->get()->count();
            $dat['origin'] = AirportcityList::find($slot->id_origin_city)->name;
            $dat['destination'] = AirportcityList::find($slot->id_destination_city)->name;
        }
        return view('admin.deliverydeparturecounters.index', $data);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function create()
    {
        $date = Input::get('date');
        $data['date'] = null;
        if ($date == null) {
            $data['datas'] = array(); 
        } else {
            $data['datas'] = PackagingList::whereDate('created_at', '=', $date)->get();
            foreach ($data['datas'] as $dat) {
                if ($dat->id_slot != null) {
                    $slot = SlotList::find($dat->id_slot);
                    $dat['origin_name'] = AirportcityList::find($slot->id_origin_city)->name;
                    $dat['destination_name'] = AirportcityList::find($slot->id_destination_city)->name;
                }
            }
            $data['date'] = $date;
        }
        return view('admin.deliverydeparturecounters.create', $data);
    }

    /**
    * Store a newly created resource in storage.
    *
-    * @return Response
    */
    public function store()
    {
        //
        $delivery = new DeliveryShipment;
        $delivery->delivery_date = Input::get('date');
        $delivery->delivery_time = Input::get('delivery_time');
        $delivery->created_by = Auth::user()->id; 
        $delivery->save();
        $delivery->delivery_id='DEL'.$delivery->id.'2017';
        $delivery->save();
        foreach(Input::get('packagings') as $shipment) {
            $deliv_details = new PackagingDelivery;
            $deliv_details->packaging_id = $shipment;
            $deliv_details->deliveries_id = $delivery->id;
            $deliv_details->save();
        }
        return Redirect::to(route('deliverydeparturecounters.index'));



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
        $data['chosen_packaging'] = PackagingList::whereIn('id',PackagingDelivery::where('deliveries_id', $id)->pluck('packaging_id')->toArray())->pluck('id')->toArray();
        $data['packaging'] = PackagingList::all();
        foreach ($data['packaging'] as $dat) {
            if ($dat->id_slot != null) {
                    $slot = SlotList::find($dat->id_slot);
                    $dat['origin_name'] = AirportcityList::find($slot->id_origin_city)->name;
                    $dat['destination_name'] = AirportcityList::find($slot->id_destination_city)->name;
                }
        }
        $data['data'] = DeliveryShipment::find($id);
        return view('admin.deliverydeparturecounters.edit', $data);

    }

    /**
    * Update the specified resource in storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function update($id)
    {
        $delivery = DeliveryShipment::find($id);

        $delivery->delivery_time = Input::get('delivery_time');
        $delivery->save();
        if (Input::get('submit') =='post') {
            $delivery->is_posted = 1;
            $delivery->save();
        }
        $delivdetails = PackagingDelivery::where('deliveries_id', $id)->delete();
        if (Input::get('packagings') != null){
            foreach(Input::get('packagings') as $shipment) {
                $deliv_details = new PackagingDelivery;
                $deliv_details->packaging_id = $shipment;
                $deliv_details->deliveries_id = $delivery->id;
                $deliv_details->save();
            }
        }
        return Redirect::to(route('deliverydeparturecounters.index'));
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
        $cityList = DeliveryShipment::find($id);
        $cityList->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the nerd!');
        return Redirect::to(route('deliverydeparturecounters.index'));
    }
}
