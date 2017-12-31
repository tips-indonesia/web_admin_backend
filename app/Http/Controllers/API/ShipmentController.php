<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Shipment;
use App\PriceList;
use App\Insurance;
use App\CityList;
use App\ShipmentStatus;
use App\DaftarBarangRegular;
use App\DaftarBarangGold;
use App\Province;
use App\City;
use App\Districts;


class ShipmentController extends Controller
{
    //
    function submit(Request $request) {
        $shipper_districts = Districts::find($request->id_shipper_district);
        $consignee_districts = Districts::find($request->id_consignee_district);

        $shipper_city = City::find($shipper_districts->id_city);
        $consignee_city = City::find($consignee_districts->id_city);

        $shipper_province = Province::find($shipper_city->id_province);
        $consignee_province = Province::find($consignee_city->id_province);

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

        $shipment->save();

        if($shipment->is_first_class) {
            $daftar_barang = new DaftarBarangGold;
        } else {
            $daftar_barang = new DaftarBarangRegular;
        }

        $daftar_barang->id_barang = $shipment->id;
        $daftar_barang->save();

        $shipment_out = Shipment::where('shipment_id', $shipment->shipment_id)->first();
        $shipment_out->origin_city = CityList::find($shipment->id_origin_city)->name;
        $shipment_out->destination_city = CityList::find($shipment->id_destination_city)->name;

        $data = array(
            'err' => null,
            'result' => array(
                'shipment' => $shipment_out,
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
            $shipment->origin_city = CityList::find($shipment->id_origin_city)->name;
            $shipment->destination_city = CityList::find($shipment->id_destination_city)->name;
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
