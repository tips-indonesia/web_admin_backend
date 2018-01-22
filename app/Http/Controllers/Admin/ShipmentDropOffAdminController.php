<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Shipment;
use App\ShipmentStatus;
use App\User;
use App\MemberList;
use App\AirportcityList;
use App\ProvinceList;
use App\CityList;
use App\SubdistrictList;
use App\Insurance;
use App\PaymentType;
use App\BankList;
use App\BankCardList;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ShipmentDropOffAdminController extends Controller
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
            $data['datas'] = Shipment::where('transaction_date', Input::get('date'));
            $data['date'] = Input::get('date');
        } else {
            $data['date'] = Carbon::now()->toDateString();
            $data['datas'] = Shipment::where('transaction_date', $data['date']);
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
        if (Input::get('registration_type')) {
            $data['registration_type'] = Input::get('registration_type');
            if (Input::get('registration_type') == 'online') {
                $data['datas'] = $data['datas']->where('is_take', 0);

            } else {
             $data['datas'] = $data['datas']->where('is_take', 2);

            }
        } else {
            $data['registration_type'] = 'online';
        }
        $data['datas'] = $data['datas']->paginate(10);
        
        foreach($data['datas'] as $dat) {
            $dat['name_origin'] = AirportcityList::find($dat->id_origin_city)->name;
            $dat['name_destination'] = AirportcityList::find($dat->id_destination_city)->name;
            $dat['status'] = ShipmentStatus::find($dat->id_shipment_status)->description;
        }
        return view('admin.shipmentdropoffs.index', $data);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function create()
    {
        //
        $data['date'] = Carbon::now()->toDateString();
        $data['registration_type'] = Input::get('registration_type');
        $data['provinces'] = ProvinceList::all();
        $data['cities'] = AirportcityList::all();
        $data['shipment_status'] = ShipmentStatus::find(1);
        $data['users'] = User::all();
        $data['payment_types'] = PaymentType::all();
        $data['banklists'] = BankList::all();
        return view('admin.shipmentdropoffs.create', $data);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @return Response
    */
    public function store()
    {
        $rules = array (
            'origin_city'=>'required',
            'destination_city'=>'required',
            'class_type'=>'required',
            'dispatch_type'=>'required',
            'shipper_first_name'=>'required',
            'shipper_last_name'=>'required',
            'shipper_address'=>'required',
            'shipper_mobile'=>'required',
            'consignee_first_name'=>'required',
            'consignee_last_name'=>'required',
            'consignee_address'=>'required',
            'consignee_mobile'=>'required',
            'shipment_content'=>'required',
            'estimated_goods_value'=>'required',
            'estimated_weight'=>'required',
            'additional_insurance'=>'required',
            'online_payment'=>'required',
            'payment_type'=>'required',
            'bank'=>'required_if:online_payment,1',
            'card_type'=>'required_if:online_payment,1',
            'card_number'=>'required_if:online_payment,1',
            'security_code'=>'required_if:online_payment,1',
            'expired_date'=>'required_if:online_payment,1',
        );
        $validator = Validator::make(Input::all(), $rules);
        \Log::info($validator->errors());
        if ($validator->fails()) {
            return Redirect::to(route('shipmentdropoffs.create'))
                ->withErrors($validator)
                ->withInput();
        } else {
            $shipment = new Shipment;
            $shipment->shipment_id = 'X2017';
            $shipment->transaction_date = Carbon::now();
            $shipment->id_origin_city = Input::get('origin_city');
            $shipment->id_destination_city = Input::get('destination_city');
            $shipment->is_first_class = Input::get('class_type') == 1;
            $shipment->shipper_first_name = Input::get('shipper_first_name');
            $shipment->shipper_last_name =  Input::get('shipper_last_name');
            $shipment->registration_type = Input::get('registration_type');
            $shipment->shipper_address = Input::get('shipper_address');
            $shipment->shipper_mobile_phone = Input::get('shipper_mobile');
            $shipment->shipper_latitude = Input::get('shipper_latitude');
            $shipment->shipper_longitude = Input::get('shipper_longitude');
            $shipment->id_shipper_city = Input::get('shipper_city');
            $shipment->id_shipper_province = Input::get('shipper_province');
            $shipment->id_shipper_districts = Input::get('shipper_subdistrict');
            $shipment->consignee_first_name = Input::get('consignee_first_name');
            $shipment->consignee_last_name =  Input::get('consignee_last_name');
            $shipment->consignee_address = Input::get('consignee_address');
            $shipment->consignee_mobile_phone = Input::get('consignee_mobile');
            $shipment->is_online_payment = Input::get('online_payment');
            $shipment->shipment_contents = Input::get('shipment_content');
            $shipment->estimate_goods_value = Input::get('estimated_goods_value');
            $shipment->estimate_weight = Input::get('estimated_weight');
            $shipment->id_payment_type = Input::get('payment_type');
            $shipment->received_by = Input::get('receive_by');
            $shipment->received_time = Input::get('received_date');
            $shipment->goods_status = Input::get('goods_status');
            $shipment->pickup_by = Input::get('pickup_by');
            $shipment->pickup_time = Input::get('pickup_time');
            $shipment->pickup_date = Input::get('pickup_date');
            $shipment->add_notes = Input::get('additional_notes');
            $shipment->is_delivery = Input::get('dispatch_type') == 'Dispatch to consignee';
            $shipment->id_device = 'admin page';
            if (Input::get('online_payment') == 1){
                $shipment->id_bank = Input::get('bank');
                $shipment->bank_card_type = Input::get('card_type');
                $shipment->card_no = Input::get('card_number');
                $shipment->card_expired_date = Input::get('expired_date');
                $shipment->card_security_code = Input::get('security_code');
            } else {
                $shipment->id_bank = null;
                $shipment->bank_card_type = null;
                $shipment->card_no = null;
                $shipment->card_expired_date = null;
                $shipment->card_security_code = null;
            }
            $shipment->id_shipment_status = 1;
            $shipment->is_take = 2;
            $shipment->add_notes = Input::get('addtional_notes');
            $shipment->insurance_cost = Insurance::all()->first()->default_insurance;
            $shipment->is_add_insurance = Input::get('additional_insurance') == 1;
            $shipment->add_insurance_cost = Input::get('additional_insurance') * Insurance::all()->first()->additional_insurance * Input::get('estimated_weight');
            $shipment->save();
            $shipment->shipment_id = $shipment->id.'2017';
            $shipment->dispatch_type = Input::get('dispatch_type');
            $shipment->save();
            Session::flash('message', 'Successfully created nerd!');
            return Redirect::to(route('shipmentdropoffs.index'));
        }

    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
    public function show($id)
    {
        if (Input::get('ajax') == 1) {
            return json_encode(Shipment::where('id_slot', $id)->get(['shipment_id', 'estimate_weight']));
        } else {
            $data['data'] = Shipment::find($id);
        $data['provinces'] = ProvinceList::all();
        $data['citys'] = CityList::where('id_province', $data['data']->shipper_province)->get();
        $data['subdistricts'] = SubdistrictList::where('id_city', $data['data']->shipper_city)->get();
        $data['cities'] = AirportcityList::all();
        $data['shipment_statuses'] = ShipmentStatus::all();
        $data['users'] = User::all();
        $data['payment_types'] = PaymentType::all();
        $data['banklists'] = BankList::all();
        $data['bankcardlists'] = BankCardList::where('id_bank', $data['data']->id_bank)->get();

        return view('admin.shipmentdropoffs.show', $data);
        }
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
    public function edit($id)
    {
        $data['data'] = Shipment::find($id);
        if ($data['data']->is_posted == 1) {
            return Redirect::to(route('shipmentdropoffs.show', $id));
        }
        $data['provinces'] = ProvinceList::all();
        $data['citys'] = CityList::where('id_province', $data['data']->shipper_province)->get();
        $data['subdistricts'] = SubdistrictList::where('id_city', $data['data']->shipper_city)->get();
        $data['cities'] = AirportcityList::all();
        $data['shipment_statuses'] = ShipmentStatus::all();
        $data['users'] = User::all();
        $data['payment_types'] = PaymentType::all();
        $data['banklists'] = BankList::all();
        $data['bankcardlists'] = BankCardList::where('id_bank', $data['data']->id_bank)->get();

        return view('admin.shipmentdropoffs.edit', $data);
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function update($id)
    {
        $rules = array (
            'origin_city'=>'required',
            'destination_city'=>'required',
            'class_type'=>'required',
            'dispatch_type'=>'required',
            'shipper_first_name'=>'required',
            'shipper_last_name'=>'required',
            'shipper_address'=>'required',
            'shipper_mobile'=>'required',
            'consignee_first_name'=>'required',
            'consignee_last_name'=>'required',
            'consignee_address'=>'required',
            'consignee_mobile'=>'required',
            'shipment_content'=>'required',
            'estimated_goods_value'=>'required',
            'goods_status'=>'required',
            'estimated_weight'=>'required',
            'additional_insurance'=>'required',
            'online_payment'=>'required',
            'payment_type'=>'required',
            'bank'=>'required_if:online_payment,1',
            'card_type'=>'required_if:online_payment,1',
            'card_number'=>'required_if:online_payment,1',
            'security_code'=>'required_if:online_payment,1',
            'expired_date'=>'required_if:online_payment,1',
        );

        $validator = Validator::make(Input::all(), $rules);
        \Log::info($validator->errors());
        if ($validator->fails()) {
            return Redirect::to(route('shipmentdropoffs.edit', $id))
                ->withErrors($validator)
                ->withInput();
        } else {
            $shipment = Shipment::find($id);
            $shipment->id_origin_city = Input::get('origin_city');
            $shipment->id_destination_city = Input::get('destination_city');
            $shipment->is_first_class = Input::get('class_type') == 1;
            $shipment->shipper_first_name = Input::get('shipper_first_name');
            $shipment->shipper_last_name =  Input::get('shipper_last_name');
            $shipment->registration_type = Input::get('registration_type');
            $shipment->shipper_address = Input::get('shipper_address');
            $shipment->shipper_mobile_phone = Input::get('shipper_mobile');
            $shipment->shipper_latitude = Input::get('shipper_latitude');
            $shipment->shipper_longitude = Input::get('shipper_longitude');
            $shipment->id_shipper_city = Input::get('shipper_city');
            $shipment->id_shipper_province = Input::get('shipper_province');
            $shipment->id_shipper_districts = Input::get('shipper_subdistrict');
            $shipment->consignee_first_name = Input::get('consignee_first_name');
            $shipment->consignee_last_name =  Input::get('consignee_last_name');
            $shipment->consignee_address = Input::get('consignee_address');
            $shipment->consignee_mobile_phone = Input::get('consignee_mobile');
            $shipment->is_online_payment = Input::get('online_payment');
            $shipment->goods_status = Input::get('goods_status');
            $shipment->shipment_contents = Input::get('shipment_content');
            $shipment->estimate_goods_value = Input::get('estimated_goods_value');
            $shipment->estimate_weight = Input::get('estimated_weight');
            $shipment->id_payment_type = Input::get('payment_type');
            $shipment->is_delivery = Input::get('dispatch_type') == 'Dispatch to consignee';
            $shipment->id_device = 'admin page';
            if (Input::get('online_payment') == 1){
                $shipment->id_bank = Input::get('bank');
                $shipment->bank_card_type = Input::get('card_type');
                $shipment->card_no = Input::get('card_number');
                $shipment->card_expired_date = Input::get('expired_date');
                $shipment->card_security_code = Input::get('security_code');
            } else {
                $shipment->id_bank = null;
                $shipment->bank_card_type = null;
                $shipment->card_no = null;
                $shipment->card_expired_date = null;
                $shipment->card_security_code = null;
            }
            $shipment->id_shipment_status = 1;
            $shipment->add_notes = Input::get('addtional_notes');
            $shipment->insurance_cost = Insurance::all()->first()->default_insurance;
            $shipment->is_add_insurance = Input::get('additional_insurance') == 1;
            $shipment->add_insurance_cost = Input::get('additional_insurance') * Insurance::all()->first()->additional_insurance * Input::get('estimated_weight');
            $shipment->save();
            $shipment->dispatch_type = Input::get('dispatch_type');
            if (Input::get('submit') == 'post') {
                $shipment->is_posted = true;
                $shipment->id_shipment_status = 2;
            }
            $shipment->save();
            Session::flash('message', 'Successfully created nerd!');
            return Redirect::to(route('shipmentdropoffs.index'));
        }
    }

    // /**
    // * Remove the specified resource from storage.
    // *
    // * @param  int  $id
    // * @return Response
    // */
    public function destroy($id)
    {
        //
        $shipment = Shipment::find($id);
        $shipment->delete();

        // // redirect
        // Session::flash('message', 'Successfully deleted the nerd!');
        return Redirect::to(route('shipmentdropoffs.index'));
    }
}
