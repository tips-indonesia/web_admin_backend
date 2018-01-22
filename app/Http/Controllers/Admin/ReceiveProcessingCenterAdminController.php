<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Shipment;
use App\DeliveryDeparture;
use App\ShipmentHistory;
use App\OfficeList;
use App\PackagingList;
use Validator;
use App\CityList;
use App\PackagingDelivery;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ReceiveProcessingCenterAdminController extends Controller
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
                $dat['origin'] = AirportcityList::find($slot->id_origin_city)->name;
                $dat['destination'] = AirportcityList::find($slot->id_destination_city)->name;
                $dat['slot_id'] = $slot->slot_id;
            }else {
                $dat['total'] = Shipment::where('id_packaging', $dat->id)->get()->count();
            }
        }
        return view('admin.receiveprocessingcenters.index', $data);
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
                    $dat['origin_name'] = CityList::find($slot->id_origin_city)->name;
                    $dat['destination_name'] = CityList::find($slot->id_destination_city)->name;
                }
            }
            $data['date'] = $date;
        }
        return view('admin.receiveprocessingcenters.create', $data);
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
        $delivery->delivery_id='DEL'.$delivery->id.'2017';
        $delivery->save();
        foreach(Input::get('packagings') as $shipment) {
            $deliv_details = new PackagingDelivery;
            $deliv_details->id_packaging = $shipment;
            $deliv_details->id_delivery = $delivery->id;
            $deliv_details->save();
        }
        return Redirect::to(route('receiveprocessingcenters.index'));



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
        $delivery_shipment_info = DeliveryDeparture::find($id);
        $delivery_shipments = PackagingDelivery::where([['id_delivery', '=', $id]])->pluck('id_shipment')->toArray();
        $temp_shipments = Shipment::where([['transaction_date', '=', $delivery_shipment_info->delivery_date], ['is_posted', '=', 1]])->whereIn('id_shipment_status', [1,2])->get();
        foreach ($temp_shipments as $dat) {
            $dat['origin_name'] = CityList::find($dat->id_origin_city)->name;
            $dat['destination_name'] = CityList::find($dat->id_destination_city)->name;
        }
        $data['delivery_shipments'] = $delivery_shipments;
        $data['shipment_lists'] = $temp_shipments;
        $data['data'] = $delivery_shipment_info;
        return view('admin.receiveprocessingcenters.edit', $data);

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
/*            foreach(Input::get('shipments') as $shipment){
                $shipment_data = Shipment::find($shipment);
                $shipment_data->id_shipment_status = 3;
                $shipment_data->save();
                $shipment_history = new ShipmentHistory;
                $shipment_history->id_shipment = $shipment_data->id;
                $shipment_history->id_shipment_status = 3;
                $shipment_history->save();
            }*/
        }
        $delivdetails = PackagingDelivery::where('id_delivery', $id)->delete();
        if (Input::get('shipments') != null){
            foreach(Input::get('shipments') as $shipment){
                $deliv_details = new PackagingDelivery;
                $deliv_details->id_shipment = $shipment;
                $deliv_details->id_delivery = $delivery->id;
                $deliv_details->save();
            }
        }
        return Redirect::to(route('receiveprocessingcenters.index'));
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
        return Redirect::to(route('receiveprocessingcenters.index'));
    }
}
