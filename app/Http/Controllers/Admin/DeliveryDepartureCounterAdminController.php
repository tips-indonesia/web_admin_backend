<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Shipment;
use App\DeliveryDeparture;
use App\DeliveryDepartureDetail;
use App\ShipmentHistory;
use App\OfficeList;
use App\PackagingList;
use App\PackagingDelivery;
use App\Delivery;
use Validator;
use App\CityList;
use App\AirportcityList;
use App\AirportList;
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
            $data['datas'] = DeliveryDeparture::where('delivery_date', Input::get('date'));
            $data['date'] = Input::get('date');
        } else {
            $data['date'] = Carbon::now()->toDateString();
            $data['datas'] = DeliveryDeparture::where('delivery_date', $data['date']);
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
        
        $selected =PackagingDelivery::all()->pluck('packaging_id')->toArray();
        $data['datas2'] = PackagingList::whereNotIn('id', $selected)->get();
        foreach ($data['datas2'] as $dat) {
            if ($dat->id_slot != null) {
                $slot = SlotList::find($dat->id_slot);
                $dat['total'] = Shipment::where('id_slot', $slot->id)->get()->count();
                $dat['origin'] = AirportList::find($slot->id_origin_airport)->name;
                $dat['destination'] = AirportList::find($slot->id_destination_airport)->name;
                $dat['slot_id'] = $slot->slot_id;
            }else {
                $dat['total'] = Shipment::where('id_packaging', $dat->id)->get()->count();
            }
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
            $selected =PackagingDelivery::all()->pluck('packaging_id')->toArray();
            $data['datas'] = PackagingList::whereDate('created_at', '=', $date)->whereNotIn('id', $selected)->get();
            foreach ($data['datas'] as $dat) {
                if ($dat->id_slot != null) {
                    $slot = SlotList::find($dat->id_slot);
                    $dat['origin_name'] = AirportList::find($slot->id_origin_airport)->name;
                    $dat['destination_name'] = AirportList::find($slot->id_destination_airport)->name;
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
        $delivery = new DeliveryDeparture;
        $delivery->delivery_date = Input::get('date');
        $delivery->delivery_time = Input::get('delivery_time');
        $delivery->created_by = Auth::user()->id; 
        $delivery->save();
        $delivery->delivery_id='PD'.date('ymd').str_pad($delivery->id, 4, '0', STR_PAD_LEFT);
        $delivery->save();
        foreach(Input::get('packagings') as $shipment) {
            $deliv_details = new PackagingDelivery;
            $deliv_details->packaging_id = $shipment;
            $deliv_details->deliveries_id = $delivery->id;
            $package = PackagingList::find($shipment);
            if ($package->id_slot != null) {
                $shipments = Shipment::where('id_slot', $package->id_slot)->get();
            } else {
                $shipments = Shipment::where('id_packaging', $package->id)->get();
            }
            foreach ($shipments as $ship) {
                $ship->id_shipment_status = 6;
                $ship->save();
            }
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
        $selected =PackagingDelivery::where('deliveries_id', '!=',$id)->pluck('packaging_id')->toArray();

        $data['packaging'] = PackagingList::whereDate('created_at', '=', DeliveryDeparture::find($id)->delivery_date)->whereNotIn('id', $selected)->get();
        foreach ($data['packaging'] as $dat) {
            if ($dat->id_slot != null) {
                    $slot = SlotList::find($dat->id_slot);
                    $dat['origin_name'] = AirportList::find($slot->id_origin_airport)->name;
                    $dat['destination_name'] = AirportList::find($slot->id_destination_airport)->name;
                }
        }
        $data['data'] = DeliveryDeparture::find($id);
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
        $delivery = DeliveryDeparture::find($id);

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
                if (Input::get('submit') =='post') {
                    $package = PackagingList::find($shipment);
                    if ($package->id_slot != null) {
                        $shipments = Shipment::where('id_slot', $package->id_slot)->get();
                    } else {
                        $shipments = Shipment::where('id_packaging', $package->id)->get();
                    }
                    foreach ($shipments as $ship) {
                        $ship->id_shipment_status = 6;
                        $ship->save();
                    }
                }
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
        $cityList = DeliveryDeparture::find($id);
        $cityList->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the nerd!');
        return Redirect::to(route('deliverydeparturecounters.index'));
    }
}
