<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DeliveryShipment;
use App\DeliveryShipmentDetail;
use App\MemberList;
use App\Shipment;
use App\ShipmentStatus;
use App\ShipmentHistory;
use App\AirportcityList;
use Auth;
use Carbon\Carbon;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\User;
use App\ProvinceList;
use App\CityList;
use App\SubdistrictList;
use App\PaymentType;
use App\BankCardList;
use App\BankList;

class ShipmentTrackingAdminController extends Controller
{
	public function index()
    {
        if (Input::get('shipment_id') != null) {
            $ship = Shipment::where('shipment_id', Input::get('shipment_id'))->first();
            if ($ship != null) {
                $id = $ship->shipment_id;
            } else {
                return back();
            }
            return Redirect::to(route('shipmenttrackings.show', $id));

        } else {
            return view('admin.shipmenttrackings.index');

        }
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
        $shipment = Shipment::where('shipment_id', $id)->get()->first();
        $data['data'] = $shipment;
        $data['datas'] = $shipment->paginate(10);
        $data['data']['origin_city'] = AirportcityList::find($shipment->id_origin_city)->name;
        $data['data']['destination_city'] = AirportcityList::find($shipment->id_destination_city)->name;
        $data['delivery'] = DeliveryShipmentDetail::where('id_shipment', $id);
        $data['shipment_trackings'] = ShipmentHistory::where('id_shipment', $shipment->id)->orderBy('created_at')->get();
        $data['shipment_status'] = ShipmentStatus::all()->keyBy('id');
        $data['shipper'] = MemberList::find($shipment->id_shipper);
        $data['cities'] = AirportcityList::all();
        $data['shipment_statuses'] = ShipmentStatus::all();
        $data['users'] = User::where('is_worker', 1)
                            ->where('id_office',User::find(Auth::id())->id_office)
                            ->get();
        $data['provinces'] = ProvinceList::all();
        $data['citys'] = CityList::all();
        $data['subdistricts'] = SubdistrictList::all();
        $data['payment_types'] = PaymentType::all();
        $data['banklists'] = BankList::all();
        $data['bankcardlists'] = BankCardList::where('id_bank', $data['data']->id_bank)->get();

        return view('admin.shipmenttrackings.show', $data);
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