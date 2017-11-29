<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Shipment;
use App\ShipmentStatus;
use App\User;
use App\MemberList;
use App\CityList;
use App\Insurance;
use App\PaymentType;
use App\BankList;
use App\BankCardList;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ShipmentAdminController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
        //
        $data['datas'] = Shipment::paginate(10);
        foreach($data['datas'] as $dat) {
            $dat['name_origin'] = CityList::find($dat->id_origin_city)->name;
            $dat['name_destination'] = CityList::find($dat->id_destination_city)->name;
            $dat['status'] = ShipmentStatus::find($dat->id_shipment_status)->description;
        }
        return view('admin.shipments.index', $data);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function create()
    {
        //
        $data['cities'] = CityList::all();
        $data['shipment_status'] = ShipmentStatus::find(1);
        $data['users'] = MemberList::all();
        $data['payment_types'] = PaymentType::all();
        $data['banklists'] = BankList::all();
        return view('admin.shipments.create', $data);
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
            // 'shipment_status'=>'required',
            // 'received_by'=>'required',
            // 'received_date'=>'required',
            'shipper_name'=>'required',
            'shipper_address'=>'required',
            'shipper_mobile'=>'required',
            // 'shipper_email_address'=>'required',
            'shipper_latitude'=>'required',
            'shipper_longitude'=>'required',
            'consignee_name'=>'required',
            'consignee_address'=>'required',
            // 'consignee_phone'=>'required',
            'consignee_mobile'=>'required',
            // 'consignee_email_address'=>'required',
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
        if ($validator->fails()) {
            return Redirect::to(route('shipments.create'))
                ->withErrors($validator)
                ->withInput();
        } else {
            $shipment = new Shipment;
            $shipment->shipment_id = 'X2017';
            $shipment->transaction_date = Carbon::now();
            $shipment->id_origin_city = Input::get('origin_city');
            $shipment->id_destination_city = Input::get('destination_city');
            $shipment->is_first_class = Input::get('class_type') == 1;
            $shipment->id_shipper = Input::get('shipper_name');
            $shipper = MemberList::find(Input::get('shipper_name'));
            $shipment->shipper_name = $shipper->name;
            $shipment->shipper_address = Input::get('shipper_address');
            $shipment->shipper_mobile_phone = Input::get('shipper_mobile');
            $shipment->shipper_latitude = Input::get('shipper_latitude');
            $shipment->shipper_longitude = Input::get('shipper_longitude');
            // $shipment->shipper_email_address = Input::get('shipper_email_address');
            // $shipment->consignee_email_address = Input::get('consignee_email_address');
            $shipment->consignee_name = Input::get('consignee_name');
            // $shipment->received_time = Input::get('received_date');
            $shipment->consignee_address = Input::get('consignee_address');
            // $shipment->consignee_phone_no = Input::get('consignee_phone');
            $shipment->consignee_mobile_phone = Input::get('consignee_mobile');
            $shipment->is_online_payment = Input::get('online_payment');
            $shipment->shipment_contents = Input::get('shipment_content');
            $shipment->estimate_goods_value = Input::get('estimated_goods_value');
            $shipment->estimate_weight = Input::get('estimated_weight');
            $shipment->id_payment_type = Input::get('payment_type');
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
            // $shipment->received_by = Input::get('received_by');
            $shipment->insurance_cost = Insurance::all()->first()->default_insurance;
            $shipment->is_add_insurance = Input::get('additional_insurance') == 1;
            $shipment->add_insurance_cost = Input::get('additional_insurance') * Insurance::all()->first()->additional_insurance * Input::get('estimated_weight');
            $shipment->save();
            $shipment->shipment_id = $shipment->id.'2017';
            $shipment->dispatch_type = Input::get('dispatch_type');
            $shipment->save();
            Session::flash('message', 'Successfully created nerd!');
            return Redirect::to(route('shipments.index'));
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

        $data['data'] = Shipment::find($id);
        if ($data['data']->is_posted == 0) {
            return Redirect::to(route('shipments.edit', $id));
        }
        $data['cities'] = CityList::all();
        $data['shipment_statuses'] = ShipmentStatus::all();
        $data['users'] = MemberList::all();
        $data['payment_types'] = PaymentType::all();
        $data['banklists'] = BankList::all();
        return view('admin.shipments.show', $data);
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
            return Redirect::to(route('shipments.show', $id));
        }
        $data['cities'] = CityList::all();
        $data['shipment_statuses'] = ShipmentStatus::all();
        $data['users'] = MemberList::all();
        $data['payment_types'] = PaymentType::all();
        $data['banklists'] = BankList::all();
        $data['bankcardlists'] = BankCardList::where('id_bank', $data['data']->id_bank)->get();

        return view('admin.shipments.edit', $data);
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
            // 'shipment_status'=>'required',
            // 'received_by'=>'required',
            // 'received_date'=>'required',
            'shipper_name'=>'required',
            'shipper_address'=>'required',
            'shipper_mobile'=>'required',
            // 'shipper_email_address'=>'required',
            'shipper_latitude'=>'required',
            'shipper_longitude'=>'required',
            'consignee_name'=>'required',
            'consignee_address'=>'required',
            // 'consignee_phone'=>'required',
            'consignee_mobile'=>'required',
            // 'consignee_email_address'=>'required',
            'shipment_content'=>'required',
            'estimated_goods_value'=>'required',
            'estimated_weight'=>'required',
            'additional_insurance'=>'required',
            'online_payment'=>'required',
            'payment_type'=>'required_if',
            'bank'=>'required_if:online_payment,1',
            'card_type'=>'required_if:online_payment,1',
            'card_number'=>'required_if:online_payment,1',
            'security_code'=>'required_if:online_payment,1',
            'expired_date'=>'required_if:online_payment,1',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Redirect::to(route('shipments.edit', $id))
                ->withErrors($validator)
                ->withInput();
        } else {
            $shipment = Shipment::find($id);
            $shipment->shipment_id = 'X2017';
            $shipment->transaction_date = Carbon::now();
            $shipment->id_origin_city = Input::get('origin_city');
            $shipment->id_destination_city = Input::get('destination_city');
            $shipment->is_first_class = Input::get('class_type') == 1;
            $shipment->id_shipper = Input::get('shipper_name');
            $shipper = MemberList::find(Input::get('shipper_name'));
            $shipment->shipper_name = $shipper->name;
            $shipment->shipper_address = Input::get('shipper_address');
            $shipment->shipper_mobile_phone = Input::get('shipper_mobile');
            $shipment->shipper_latitude = Input::get('shipper_latitude');
            $shipment->shipper_longitude = Input::get('shipper_longitude');
            // $shipment->received_time = Input::get('received_date');
            // $shipment->shipper_email_address = Input::get('shipper_email_address');
            // $shipment->consignee_email_address = Input::get('consignee_email_address');
            $shipment->consignee_name = Input::get('consignee_name');
            $shipment->consignee_address = Input::get('consignee_address');
            // $shipment->consignee_phone_no = Input::get('consignee_phone');
            $shipment->consignee_mobile_phone = Input::get('consignee_mobile');
            $shipment->is_online_payment = Input::get('online_payment');
            $shipment->shipment_contents = Input::get('shipment_content');
            $shipment->estimate_goods_value = Input::get('estimated_goods_value');
            $shipment->estimate_weight = Input::get('estimated_weight');
            $shipment->id_payment_type = Input::get('payment_type');
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
            // $shipment->received_by = Input::get('received_by');
            $shipment->insurance_cost = Insurance::all()->first()->default_insurance;
            $shipment->is_add_insurance = Input::get('additional_insurance') == 1;
            $shipment->add_insurance_cost = Input::get('additional_insurance') * Insurance::all()->first()->additional_insurance * Input::get('estimated_weight');
            $shipment->save();
            $shipment->shipment_id = $shipment->id.'2017';
            $shipment->dispatch_type = Input::get('dispatch_type');
            if (Input::get('submit') == 'post') {
                $shipment->is_posted = true;
            }
            $shipment->save();
            Session::flash('message', 'Successfully created nerd!');
            return Redirect::to(route('shipments.index'));
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
        // $shipment = Shipment::find($id);
        // $shipment->delete();

        // // redirect
        // Session::flash('message', 'Successfully deleted the nerd!');
        // return Redirect::to(route('shipments.index'));
    }
}
