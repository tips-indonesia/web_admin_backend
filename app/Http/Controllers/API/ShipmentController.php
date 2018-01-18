<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Shipment;
use App\PriceList;
use App\Insurance;
use App\AirportcityList;
use App\ShipmentStatus;
use App\DaftarBarangRegular;
use App\DaftarBarangGold;
use App\ProvinceList;
use App\CityList;
use App\SubdistrictList;


class ShipmentController extends Controller
{
    //
    function submit(Request $request) {
        $shipper_districts = SubdistrictList::find($request->id_shipper_district);
        $consignee_districts = SubdistrictList::find($request->id_consignee_district);

        $shipper_city = CityList::find($shipper_districts->id_city);
        $consignee_city = CityList::find($consignee_districts->id_city);

        $shipper_province = ProvinceList::find($shipper_city->id_province);
        $consignee_province = ProvinceList::find($consignee_city->id_province);

        $insurance = Insurance::first();
        do{
            $random_string = $this->generateRandomString();
        }while(Shipment::where('shipment_id', $random_string)->first() != null);

        $id_origin_city = $request->id_origin_city;
        $id_destination_city = $request->id_destination_city;
        $price = PriceList::where('id_origin_city', $id_origin_city)->where('id_destination_city', $id_destination_city)->first();

        $shipment = new Shipment;
        $shipment->shipment_id = $random_string;
        $shipment->transaction_date = \Carbon\Carbon::now();
        $shipment->id_origin_city = $request->id_origin_city;
        $shipment->id_destination_city = $request->id_destination_city;
        $shipment->is_first_class = $request->is_first_class;
        $shipment->id_device = $request->id_device;
        if($request->has('id_shipper')){
            if($request->id_shipper != null && $request->id_shipper != ""){
                $shipment->id_shipper = $request->id_shipper;
            }
        }

        $shipment->shipper_first_name = $request->shipper_first_name;
        if($request->has('shipper_last_name')) {
            if($request->shipper_last_name != null && $request->shipper_last_name != ""){
                $shipment->shipper_last_name = $request->shipper_last_name;
            }
        }

        $shipment->id_shipper_districts = $shipper_districts->id;
        $shipment->shipper_districts = $shipper_districts->name;
        $shipment->id_shipper_city = $shipper_city->id;
        $shipment->shipper_city = $shipper_city->name;
        $shipment->id_shipper_province = $shipper_province->id;
        $shipment->shipper_province = $shipper_province->name;

        $shipment->shipper_address = $request->shipper_address;
        $shipment->shipper_mobile_phone = $request->shipper_mobile_phone;
        $shipment->shipper_latitude = $request->shipper_latitude;
        $shipment->shipper_longitude = $request->shipper_longitude;

//        $shipment->consignee_name = $request->consignee_name;
        $shipment->consignee_first_name = $request->consignee_first_name;

        if($request->has('consignee_last_name')) {
            if($request->consignee_last_name != null && $request->consignee_last_name != ""){
                $shipment->consignee_last_name = $request->consignee_last_name;
            }
        }

        $shipment->id_consignee_districts = $consignee_districts->id;
        $shipment->consignee_districts = $consignee_districts->name;
        $shipment->id_consignee_city = $consignee_city->id;
        $shipment->consignee_city = $consignee_city->name;
        $shipment->id_consignee_province = $consignee_province->id;
        $shipment->consignee_province = $consignee_province->name;

        $shipment->consignee_address = $request->consignee_address;
        $shipment->consignee_mobile_phone = $request->consignee_mobile_phone;
        $shipment->id_payment_type = $request->id_payment_type;
        $shipment->shipment_contents = $request->shipment_contents;
        $shipment->estimate_goods_value = $request->estimate_goods_value;
        $shipment->estimate_weight = $request->estimate_weight;
        $shipment->insurance_cost = $insurance->default_insurance;
        $shipment->is_add_insurance = $request->is_add_insurance;
        if($request->is_add_insurance == 1) {
            $shipment->add_insurance_cost = $insurance->additional_insurance;
        } else {
            $shipment->add_insurance_cost = 0;
        }

        if($request->is_first_class == 1) {
            $shipment->flight_cost = ($price->freight_cost + $price->add_first_class)*$request->estimate_weight;
        } else {
            $shipment->flight_cost = $price->freight_cost*$request->estimate_weight;
        }

        $shipment->is_delivery = $request->is_delivery;
        $shipment->is_take = $request->is_take;
        $shipment->payment_id = "TIPS" . strtoupper("" . uniqid());

        if($request->has('notes_address')) {
            if($request->notes_address != null && $request->notes_address != ""){
                $shipment->notes_address = $request->notes_address;
            }
        }

        $shipment->save();

        if($shipment->is_first_class) {
            $daftar_barang = new DaftarBarangGold;
        } else {
            $daftar_barang = new DaftarBarangRegular;
        }

        $daftar_barang->id_barang = $shipment->id;
        $daftar_barang->save();

        $shipment_out = Shipment::where('shipment_id', $shipment->shipment_id)->first();
        $shipment_out->origin_city = AirportcityList::find($shipment->id_origin_city)->name;
        $shipment_out->destination_city = AirportcityList::find($shipment->id_destination_city)->name;

        $data = array(
            'err' => null,
            'result' => array(
                'shipment' => $shipment_out,
                'payment_url' => "http://174.138.24.62/payment/start?payment_id=$shipment->payment_id"
            )
        );

        return response()->json($data, 200);
    }

    function get_status(Request $request) {
        $shipment_id = $request->shipment_id;
        $shipment = Shipment::where('shipment_id', $shipment_id)->first();

        if($shipment == null) {
            $data = array(
                'err' => [
                    'code' => 0,
                    'message' => 'Shipment tidak ditemukan'
                ],
                'result' => null
            );
        } else {
            $shipment_status = ShipmentStatus::find($shipment->id_shipment_status);
            $shipment->origin_city = AirportcityList::find($shipment->id_origin_city)->name;
            $shipment->destination_city = AirportcityList::find($shipment->id_destination_city)->name;
            $data = array(
                'err' => null,
                'result' => array(
                    'status' => array(
                        'step' => $shipment_status->step,
                        'description' => $shipment_status->description,
                        'detail' => $shipment->detail_status
                    ),
                    'shipment' => $shipment
                )

            );
        }

        return response()->json($data, 200);
    }

    function search_shipment(Request $request) {

        $shipement = Shipment::where('id_shipper', $request->id_member);

        if($request->has('id_destination_city')){
            if($request->id_destination_city != null && $request->id_destination_city != "") {
                $shipement = $shipement->where('id_destination_city', $request->id_destination_city);
            }
        }

        if($request->has('id_shipment_status')){
            if($request->id_shipment_status != null && $request->id_shipment_status != "" && $request->id_shipment_status != 0) {
                $shipement = $shipement->where('id_shipment_status', $request->id_shipment_status);
            }
        }

        if($request->has('start_transaction_date') && $request->has('end_transaction_date')){
            if($request->start_transaction_date != null && $request->start_transaction_date != "" && $request->end_transaction_date != null && $request->end_transaction_date != "") {
                $shipement = $shipement->where('transaction_date','>=' ,$request->start_transaction_date)->where('transaction_date','<=' ,$request->end_transaction_date);
            }
        }

        if($request->has('consignee_name')){
            if($request->consignee_name != null && $request->consignee_name != "") {
                $shipement = $shipement->where('consignee_first_name', 'LIKE','%'.$request->consignee_name.'%')->orWhere('consignee_last_name','LIKE', '%'.$request->consignee_name.'%');
            }
        }

        $shipment_init = $shipement->get();
        $shipments = [];

        foreach ($shipment_init as $shipment) {
            $shipment->origin_city = AirportcityList::find($shipment->id_origin_city)->name;
            $shipment->destination_city = AirportcityList::find($shipment->id_destination_city)->name;

            array_push($shipments, $shipment);
        }

        $data = array(
            'err' => null,
            'result' => $shipments
        );

        return response()->json($data, 200);
    }

    function get_all_status_shipments() {
        $shipment_status = ShipmentStatus::all();
        $data = array(
            'err' => null,
            'result' => $shipment_status
        );

        return response()->json($data, 200);
    }

    function generateRandomString($length = 7) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
