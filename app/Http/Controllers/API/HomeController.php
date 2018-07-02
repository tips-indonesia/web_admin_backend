<?php

namespace App\Http\Controllers\API;

use App\Shipment;
use App\SlotList;
use App\MemberList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\WalletAll;
use App\Http\Controllers\ConfigHunter;
use DateTime;

class HomeController extends Controller{

    function getOnlyShipmentsForAnonymousUser($id_device){
        // Mengambil pengguna yang terkait dengan device tersebut atau jika
        // pengguna tidak ditemukan, akan dibuatkan sebuah akun baru referrence
        // ke id device tersebut.
        // Pengguna aplikasi TIPS yang tidak login dapat membuat shipment
        // shipment akan dikenali melalui id device pengguna tersebut.
        $member_list    = UserController::getAnonOrRegister($id_device, null);

        // Mengambil daftar shipment terkait dengan user device
        $shipments      = Shipment::where('id_shipper', $member_list->id)->get();

        return [
            'S' => $shipments,
            'D' => []
        ];
    }

    function getShipmentDeliveryForRegisteredUser($id_member){
        // Mengambil daftar shipment dan slot (delivery) yang terkait
        // dengan id member yang telah terdaftar
        $shipments      = Shipment::where('id_shipper', $id_member)->get();
        $deliveries     = SlotList::where('id_member',  $id_member)->get();

        return [
            'S' => $shipments,
            'D' => $deliveries
        ];
    }

    function list_of_shipment_and_delivery(Request $request){
        // Mengambil passing parameter request berupa
        // - member ID
        // - device ID
        $member_id = $request->member_id;
        $device_id = $request->device_id;

        // Inisialisasi variabel
        $dataSD = [];
        $money  = 0;

        // Untuk mengambil daftar shipment dan delivery, pengguna harus terdaftar
        // terlebih dahulu ke sistem.
        // Pengguna anonymous hanya bisa mendaftarkan shipment saja, sehingga
        // data yang dikembalikan hanya shipment saja.
        // Pencegahan jika parameter salah, parameter minimal ada 
        // - member_id (dideteksi sebagai pengguna terdaftar)
        // - device_id (dideteksi sebagai pengguna anonim)
        if(!$member_id && $device_id)
            $dataSD = $this->getOnlyShipmentsForAnonymousUser($device_id);
        else if($member_id){
            $dataSD = $this->getShipmentDeliveryForRegisteredUser($member_id);
            $money  = $this->getMoney($member_id);
        }else{
            $data = array(
                'err' => [
                    'code' => 0,
                    'message' => 'parameter minimal harus member_id atau device_id, tidak boleh kosong'
                ],
                'result' => null
            );

            return response()->json($data, 200);
        }

        // Shipment yang dikembalikan harus memenuhi ketiga syarat berikut:
        // 1. bukan status 15
        // 2. tanggal minimal sehari sebelum hari ini
        // 3. belum di cancel oleh user
        $outshipment = [];
        foreach ($dataSD['S'] as $key => $shipment){
            if(!($shipment->id_shipment_status == 15 && $this->isADayAfter($shipment->updated_at)) && !$shipment->trashed()){
                array_push($outshipment, ShipmentController::___get_status($shipment->shipment_id));
            }
        }

        // Delivery yang dikembalikan harus memenuhi dua syarat:
        // 1. bukan status 7 (Selesai)
        // 2. tanggal minimal sehari sebelum hari ini
        $outdelivery = [];
        foreach ($dataSD['D'] as $key => $deliv){
            if(!($deliv->id_slot_status == 7 && $this->isADayAfter($deliv->updated_at)))
                array_push($outdelivery, DeliveryController::___get_status($deliv->slot_id));
        }
        
        $etc_text = ConfigHunter::isExist(ConfigHunter::$ETC_MESSAGE);

        $data = array(
            'err' => null,
            'result' => array (
                'shipments'     => $outshipment,
                'delivery'      => $outdelivery,
                'money'         => $money,
                'static_data'   => [
                    'airport'               => (new FlightController)->airport_list(),
                    'goods_weight'          => [
                        'shipment'          => (new GoodsController)->list_weight('Shipment'),
                        'delivery'          => (new GoodsController)->list_weight('Delivery')
                    ],
                    'airport_city'          => (new CityController)->airport_city_list(),
                    'airport_city_price'    => (new CityController)->get_airport_city_list_price($member_id),
                    'location'              => [
                        'province'          => (new LocationController)->get_all_province(),
                        'city'              => (new LocationController)->get_all_city(),
                        'subdistrict'       => (new LocationController)->get_all_subdistrict()
                    ],
                    'price_goods_estimate'  => (new GoodsController)->list_price_estimate(),
                    'payment_method'        => (new PaymentController)->payment_method_all(),
                    'insurance'             => (new GoodsController)->insurance($member_id)
                ],
                'etc_message'   => $etc_text ? $etc_text->value : ""
            )
        );

        return response()->json($data, 200);
    }

    function isADayAfter($datetime_instance){
        $checkTime = (new DateTime($datetime_instance))->modify('+1 day');
        $nowTime = new DateTime();
        // echo $checkTime->format('Y-m-d h:i') . '; ';
        // echo $nowTime->format('Y-m-d h:i') . '; ';
        return $checkTime <= $nowTime;
    }

    function getMoney($id){
        return WalletAll::getWalletAmount($id);
    }

    function apiMoney(Request $req){
        if(!$req->has('member_id')){
            $data = array(
                'err' => [
                    'code' => 400,
                    'message' => 'parameter minimal harus member_id, tidak boleh kosong'
                ],
                'result' => null
            );

            return response()->json($data, 200);
        }

        $member = MemberList::find($req->member_id);
        if(!$member){
            $data = array(
                'err' => [
                    'code' => 404,
                    'message' => 'Member tidak ditemukan'
                ],
                'result' => null
            );

            return response()->json($data, 200);
        }

        $data = array(
            'err' => null,
            'result' => [
                'money' => $this->getMoney($req->member_id)
            ]
        );

        return response()->json($data, 200);
        //
    }
}
