<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BirdSenderController;
use App\Http\Controllers\cURLFaker;

use App\Shipment;
use App\PriceList;
use App\Insurance;
use App\AirportcityList;
use App\ShipmentStatus;
use App\DaftarBarangRegular;
use App\DaftarBarangGold;
use App\ProvinceList;
use App\MemberList;
use App\CityList;
use App\SubdistrictList;
use App\PriceGoodsEstimate;
use App\SlotList;
use App\Http\Controllers\FCMSender;
use App\Http\Controllers\API\MessageController;
use App\FavoriteAddress;

class ShipmentController extends Controller
{
    public function saveShipment(Shipment $shipment){

        // request anonim akan menggunakan akun member yg telah 
        // terdaftar sebelumnya atau dibuatkan akun baru
        // sebagai pengenal
        if($shipment->id_shipper == null){
            // passing params:
            //  mobile_phone_no  => id device
            //  token            => token
            $member_list = UserController::getAnonOrRegister($shipment->id_device, $shipment->token);
            $shipment->id_shipper = $member_list->id;
        }

        $shipment->save();

        return $shipment;
    }


    function submit(Request $request) {


        // =================================================
        // BEGIN OF SUBMIT SHIPMENT
        // =================================================

        // 1. INITIAL STEP
        // ---------------
        // Instantiate new Shipment instance
        $shipment = new Shipment;

        // 1. A. PRIMER DATAS
        // ------------------
        $shipment->is_first_class               = $request->is_first_class;
        $shipment->id_device                    = $request->id_device;
        $shipment->id_origin_city               = $request->id_origin_city;
        $shipment->id_destination_city          = $request->id_destination_city;
        $shipment->id_payment_type              = $request->id_payment_type;
        $shipment->shipment_contents            = $request->shipment_contents;
        $shipment->estimate_weight              = $request->estimate_weight;
        $shipment->is_add_insurance             = $request->is_add_insurance;
        $shipment->shipper_first_name           = $request->shipper_first_name;
        $shipment->consignee_first_name         = $request->consignee_first_name;
        $shipment->is_delivery                  = $request->is_delivery;
        $shipment->is_take                      = $request->is_take;

        // 1. A. a. CONSIGNEE DATAS
        // ------------------------
        $shipment->consignee_postal_code        = $request->consignee_postal_code;
        $shipment->consignee_address            = $request->consignee_address;
        $shipment->consignee_mobile_phone       = $request->consignee_mobile_phone;
        $shipment->consignee_keterangan_tempat    = $request->consignee_keterangan_tempat_penerima;
        // 1. A. b. SHIPPER DATAS
        // ----------------------
        $shipment->shipper_postal_code          = $request->shipper_postal_code;
        $shipment->shipper_address              = $request->shipper_address;
        $shipment->shipper_mobile_phone         = $request->shipper_mobile_phone;
        $shipment->shipper_keterangan_tempat    = $request->shipper_keterangan_tempat_pengirim;
        // 1. A. c. LET DATAS
        $id_estimate_goods_value                = $request->id_estimate_goods_value;
        $id_consignee_district                  = $request->id_consignee_district;
        $id_shipper_district                    = $request->id_shipper_district;

        // 1. B. SECOND (DERIVED) DATAS
        // ----------------------------
        // 1. B. a. CONSIGNEE DATAS
        // ------------------------
        // subdistrict
        $consignee_districts                    = SubdistrictList::find($id_consignee_district);
        $shipment->id_consignee_districts       = $consignee_districts->id;
        $shipment->consignee_districts          = $consignee_districts->name;

        // city
        $consignee_city                         = CityList::find($consignee_districts->id_city);
        $shipment->id_consignee_city            = $consignee_city->id;
        $shipment->consignee_city               = $consignee_city->name;

        // province
        $consignee_province                     = ProvinceList::find($consignee_city->id_province);
        $shipment->id_consignee_province        = $consignee_province->id;
        $shipment->consignee_province           = $consignee_province->name;

        // 1. B. b. SHIPPER DATAS
        // ----------------------
        // subdistrict
        $shipper_districts                      = SubdistrictList::find($id_shipper_district);
        $shipment->id_shipper_districts         = $shipper_districts->id;
        $shipment->shipper_districts            = $shipper_districts->name;

        // city
        $shipper_city                           = CityList::find($shipper_districts->id_city);
        $shipment->id_shipper_city              = $shipper_city->id;
        $shipment->shipper_city                 = $shipper_city->name;

        // province
        $shipper_province                       = ProvinceList::find($shipper_city->id_province);
        $shipment->id_shipper_province          = $shipper_province->id;
        $shipment->shipper_province             = $shipper_province->name;

        // 1. C. THIRD (OPTIONAL) DATAS
        // ----------------------------
        if($request->has('consignee_latitude') && $request->has('consignee_longitude')) {
            if($request->consignee_latitude != null && $request->consignee_latitude != "" && $request->consignee_longitude != null && $request->consignee_longitude != "") {
                $shipment->consignee_latitude   = $request->consignee_latitude;
                $shipment->consignee_longitude  = $request->consignee_longitude;
            }
        }
        if($request->has('shipper_latitude') && $request->has('shipper_longitude')) {
            if($request->shipper_latitude != null && $request->shipper_latitude != "" && $request->shipper_longitude != null && $request->shipper_longitude != "") {
                $shipment->shipper_latitude     = $request->shipper_latitude;
                $shipment->shipper_longitude    = $request->shipper_longitude;
            }
        }

        if($request->has('shipper_last_name')) {
            if($request->shipper_last_name != null && $request->shipper_last_name != ""){
                $shipment->shipper_last_name    = $request->shipper_last_name;
            }
        }
        
        if($request->has('consignee_last_name')) {
            if($request->consignee_last_name != null && $request->consignee_last_name != ""){
                $shipment->consignee_last_name  = $request->consignee_last_name;
            }
        }

        $shipment->shipper_address_detail = "No notes";
        if($request->has('shipper_address_detail')) {
            if($request->shipper_address_detail != null && $request->shipper_address_detail != ""){
                $shipment->shipper_address_detail = $request->shipper_address_detail;
            }
        }

        $shipment->consignee_address_detail = "No notes";
        if($request->has('consignee_address_detail')) {
            if($request->consignee_address_detail != null && $request->consignee_address_detail != ""){
                $shipment->consignee_address_detail = $request->consignee_address_detail;
            }
        }
        
        if($request->has('espay_payment_code')) {
            if($request->espay_payment_code != null && $request->espay_payment_code != ""){
                $shipment->payment_id           = $request->espay_payment_code;
            }
        }

        // id shipper akan di cek lagi nanti pada tahap akhir ketika akan disimpan
        // jika tidak ada id shipper maka dicari id anonim yang bersangkutan berdasarkan
        // id device, jika tidak ada maka dibuat yg baru.
        if($request->has('id_shipper')){
            $shipment->id_shipper = null;
            if($request->id_shipper != null && $request->id_shipper != ""){
                $shipment->id_shipper           = $request->id_shipper;
            }
        }

        // 2. PRICING STEP
        // ---------------
        // tahap ini berisi tentang bagaimana pemberian harga pengiriman 
        // pada shipment berdasarkan data-data yang diatur pada administrator 
        // TIPS. Data yang diatur berupa:
        //      1. Estimasi asuransi harga pengiriman (PriceGoodsEstimate)
        //      2. Asuransi (Insurance)
        //      3. Harga pengiriman barang dari kota asal ke kota tujuan (PriceList)
        //
        $price_goods_estimate                   = PriceGoodsEstimate::find($id_estimate_goods_value);
        $shipment->estimate_goods_value         = $price_goods_estimate->price_estimate;

        $insurance                              = Insurance::first();

        // default value if insurance is not added
        $shipment->insurance_cost               = 0;

        // if insurance is added
        // ini udh ga dipake lagi (Benny, 22 Mei 2018 on Whatsapp)
        // if($request->is_add_insurance == 1) {
        //     $shipment->insurance_cost           = ($price_goods_estimate->nominal * $insurance->default_insurance) / 100;
        // }

        $price = PriceList::where('id_origin_city', $shipment->id_origin_city)
                ->where('id_destination_city', $shipment->id_destination_city)->first();


        $promo_percent = 0;
        $promotion = PromotionController::getUserPromoOrNULL($shipment->id_shipper);
        if($promotion['promo']){
            $promo_percent = $promotion['promo']->discount_value / 100;
        }

        // if($request->is_first_class == 1) {

        //     $gold                               = $price->freight_cost + $price->add_first_class;
        //     $gold                               = $gold + (($gold * $insurance->default_insurance) /100);
        //     $gold                               = $this->round_nearest_hundreds($gold);

        //     $shipment->flight_cost              = ($gold * $request->estimate_weight) + $shipment->insurance_cost;
        // } else {

        // }

        $shipment->flight_cost              = $shipment->estimate_weight * $price->freight_cost;
        $shipment->flight_cost              -= $promo_percent * $shipment->flight_cost;
        
        $shipment->add_insurance_cost       = 0;
        if($request->is_add_insurance == 1) {
            $shipment->add_insurance_cost       = $insurance->default_insurance * $price_goods_estimate->nominal / 100;
            $shipment->add_insurance_cost       -= $promo_percent * $shipment->add_insurance_cost;
        }

        // 3. NON-REQUEST DATAS
        // --------------------
        // fill the non-request parameter datas
        // generate unique string for shipment ID
        do {
            $random_string                      = $this->generateRandomString();
        } while(Shipment::where('shipment_id', $random_string)->first() != null);

        $shipment->shipment_id                  = $random_string;
        $shipment->id_shipment_status           = 1;
        $shipment->transaction_date             = \Carbon\Carbon::now()->toDateTimeString();

        // 4. SAVE DATAS
        // -------------
        $shipment_out = $this->saveShipment($shipment);
        $shipment_out->create_transaction_estimation();
        $shipment_out->smsStep1();

        // =================================================
        // END OF SUBMIT SHIPMENT
        // =================================================




        // RESPONSE SECTION
        // respon yang dikembalikan ke pengguna membutuhkan tambahan seperti 
        // data lengkap kota asal, kota tujuan, dan status yang tersimpan pada
        // basis data.
        $shipment_out->origin_city                  = AirportcityList::find($shipment->id_origin_city)->name;
        $shipment_out->destination_city             = AirportcityList::find($shipment->id_destination_city)->name;
        $shipment_out->shipment_status_description  = ShipmentStatus::where('step', 
                                                      $shipment_out->id_shipment_status)->first()->description;

        // USER NOTIFICATION SECTION
        // setelah menyimpan data dan menyiapkan respon yang akan dikirimkan
        // ke pengguna (member list), tahap berikutnya adalah memberikan
        // pemberitahuan kepada pengguna bahwa shipment telah dibuat
        // melalui email (untuk pengguna terdaftar) dan notifikasi push
        // notification FCM (firebase cloud messaging)
        $ms_user = MemberList::find($shipment_out->id_shipper);
        $mess = 'Pengiriman Anda dengan kode ' 
                . $shipment_out->shipment_id 
                . ' telah terdaftar. Tim TIPS akan segera menghubungi Anda.';

        // atribut firebase_sent digunakan untuk debugging respon pada aplikasi 
        // end user mengenai alasan pemberitahuan firebase jika tidak terkirim.
        $firebase_sent = "";

        // PENGIRIMAN FCM
        // pengiriman fcm dilakukan dengan mengirimkan pesan ke satu pengguna
        // dengan identifikasi fcm token. Jika token tidak tersimpan pada data
        // pengguna maka fcm tidak dikirim dan pada atribut firebase_sent diberikan
        // alasan kegagalan pengiriman fcm tersebut.
        if($ms_user){
            if($ms_user->token) {
                FCMSender::post(array(
                    'type' => 'Shipment',
                    'id' => $shipment_out->shipment_id,
                    'status' => "1",
                    'message' => $mess,
                    'detail' => ""
                ), $ms_user->token);
                $firebase_sent = \Carbon\Carbon::now()->toDateTimeString();
            }else{
                $firebase_sent = "only user, no token";
            }
            MessageController::sendMessageToUser("TIPS", $ms_user, "Shipment Status", "1", $mess);
        }else{
            $firebase_sent = "no user: " . $shipment_out->id_shipper;
        }

        // PENGIRIMAN EMAIL
        // pengiriman email dilakukan berdasarkan email yang terdapat pada 
        // data email member list. Jika akun anonim maka email tidak tersedia
        // dan tidak dilakukan pengiriman email
        $bsc = new cURLFaker;
        if($ms_user){
            $email = $ms_user->email;
            $nama = $ms_user->first_name . ' ' . $ms_user->last_name;
            $kirimcode = $shipment_out->shipment_id;
            if($email)
                $bsc->sendMailShipperStep1($email, $nama, $kirimcode, "+62 823 1777 6008");
        }

        // TAHAP PENYIMPANAN FAVORITE ADDRESS
        $favAddress_pengirim_status = null;
        $favAddress_penerima_status = null;
        if ($request->has('verse2') && $request->verse2) {
            if ($request->savePengirim) {
                $favAddress_pengirim_status = (new FavoriteAddressController)
                    ->storeFavAddressVerse2($request, 'shipper', $shipper_province->id);
            }
            if ($request->savePenerima) {
                $favAddress_penerima_status = (new FavoriteAddressController)
                    ->storeFavAddressVerse2($request, 'consignee', $consignee_province->id);
            }
        } else {
            if ($request->savePengirim) {
                $favAddress_pengirim_status = (new FavoriteAddressController)->storeFavoriteAddress($request, 'pengirim');
            }
            if ($request->savePenerima) {
                $favAddress_penerima_status = (new FavoriteAddressController)->storeFavoriteAddress($request, 'penerima');
            }
        }


        // TAHAP PENGIRIMAN RESPON
        // respon dikirim akan diproses dalam bentuk objek JSON menggunakan
        // method yang disediakan oleh framework ini (Laravel).
        $data = array(
            'err' => null,
            'result' => array(
                'firebase_sent_time' => $firebase_sent,
                'shipment' => $shipment_out,
                'payment_url' => "http://174.138.24.62/payment/start?payment_id=$shipment->payment_id",
                'fav_address_pengirim_status' => $favAddress_pengirim_status,
                'fav_address_penerima_status' => $favAddress_penerima_status
            )
        );

        return response()->json($data, 200);
    }

    public static function ___get_status($shipment_id){
        $shipment = Shipment::where('shipment_id', $shipment_id)->first();

        if($shipment == null) {
            return null;
        } else {
            $shipment_status = ShipmentStatus::where('id','<=',$shipment->id_shipment_status)->where('is_hidden',false)->orderBy('id', 'desc')->first();
            $shipment->origin_city = AirportcityList::find($shipment->id_origin_city)->name;
            $shipment->destination_city = AirportcityList::find($shipment->id_destination_city)->name;


            // #######################
            // Exception Status 1 - 15
            // #######################
            // Begin 
            // 
            switch ($shipment_status->step) {
                case '6':
                    $shipment_status->description .= "(" . $shipment->destination_city . ")";
                    break;
            }
            //
            // END 
            // #######################
            $slot = false;
            if($shipment->id_slot)
                $slot = SlotList::find($shipment->id_slot);

            return array(
                'status' => array(
                    'step' => $shipment_status->step,
                    'description' => $shipment_status->description,
                    'detail' => $shipment->detail_status
                ),
                'shipment' => $shipment,
                'addt_info' => array(
                    'kode_bandara_asal' => $slot ? $slot->airportOrigin->initial_code : "",
                    'kode_bandara_tujuan' => $slot ? $slot->airportDestination->initial_code : "",
                    'flight_code' => $slot ? $slot->flight_code : "",
                    'airline_name' => $slot ? FlightController::getAirlineNameOfFlightCode($slot->flight_code) : ""
                )
            );
        }
    }

    function get_status(Request $request) {
        $shipment_id = $request->shipment_id;
        $resdata = ShipmentController::___get_status($shipment_id);

        if($resdata == null) {
            $data = array(
                'err' => [
                    'code' => 0,
                    'message' => 'Shipment tidak ditemukan'
                ],
                'result' => null
            );
        } else {
            $data = array(
                'err' => null,
                'result' => $resdata
            );
        }

        return response()->json($data, 200);
    }

    function search_shipment(Request $request) {

        $shipement = [];

        // dd($request->device_id, $request->id_shipper);

        if($request->has('device_id'))
            $shipement = Shipment::withTrashed()->where('id_shipper', $request->id_member)->orWhere('id_device', $request->device_id);
        else
            $shipement = Shipment::withTrashed()->where('id_shipper', $request->id_member);

        if($request->has('id_destination_city')){
            if($request->id_destination_city != null && $request->id_destination_city != "") {
                $shipement = $shipement->where('id_destination_city', $request->id_destination_city);
            }
        }

        if($request->has('id_shipment_status')){
            if($request->id_shipment_status != null && $request->id_shipment_status != "" && $request->id_shipment_status != 0) {
                if ($request->id_shipment_status == -1) {
                    $shipement = $shipement->where('id_shipment_status', '<', 0); 
                } if ($request->id_shipment_status == 99) {
                    $shipement = $shipement->where('id_shipment_status', 0); 
                }else {
                   $shipement = $shipement->where('id_shipment_status', $request->id_shipment_status);
                }
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

            if($shipment->id_shipment_status > 0) {
                $shipment_status = ShipmentStatus::find($shipment->id_shipment_status);
                $shipment->shipment_status_description = $shipment_status->description;
            } else if ($shipment->id_shipment_status == 0){
                $shipment->shipment_status_description = 'Batal';
            } else {
                $shipment->shipment_status_description = 'Reject';
            }

            array_push($shipments, $shipment);
        }

        $data = array(
            'err' => null,
            'result' => $shipments
        );

        return response()->json($data, 200);
    }

    function all_status_shipments(){
        $shipment_status = ShipmentStatus::where('is_hidden', 0)->get();
        $all = array();
        foreach ($shipment_status as $status) {
            array_push($all, $status);
        }
        $dumm = array(
            'id' => 99,
            'description' => 'Batal',
            'step' => 0,
            'is_hidden' => 0,
            'created_at' => '2018-03-29 10:38:59',
            'updated_at' => '2018-03-29 10:38:59'
        );
        array_push($all, $dumm);
        $dumm = [
            'id' => -1,
            'description' => 'Reject',
            'step' => -1,
            'is_hidden' => 0,
            'created_at' => '2018-03-29 10:38:59',
            'updated_at' => '2018-03-29 10:38:59'
        ];
        array_push($all, $dumm);
        return $all;
    }

    function get_all_status_shipments() {
        $shipment_status = $this->all_status_shipments();
        
        $data = array(
            'err' => null,
            'result' => $shipment_status
        );

        return response()->json($data, 200);
    }

    function cancel_shipment(Request $request) {

        // sekarang
        // select * from shipments where id_shipper = X and id_shipment_status = 1 or shipment_id = Y

        // seharusnya
        // select * from shipments where shipment_id = Y

        // 11 Mei 2018
        // TODO: perbaiki nanti

        $shipment = Shipment::where('id_shipper', $request->id_shipper)->where('id_shipment_status', 1)->orWhere('shipment_id', $request->shipment_id)->first();
        if($shipment == null) {
            $data = array(
                'err' => [
                    'code' => 0,
                    'message' => 'Shipment tidak ditemukan, shipment sudah melalui process atau id member tidak cocok'
                ],
                'result' => null
            );
        } else {
            $shipment->status_dispatch = 'Canceled';
            $shipment->id_shipment_status = 0;
            $shipment->save();
            $shipment->delete_transaction_estimation();
            $shipment->delete();

            $data = array(
                'err' => null,
                'result' => [
                    'code' => 1,
                    'message' => 'Shipment berasil dibatalkan'
                ]
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

    function round_nearest_hundreds($number) {
        $number = round($number);
        if($number % 100 == 0) {
            return $number;
        } else {
            $number = (round($number / 100) + 1) * 100;
            return $number;
        }
    }

    private function CekDataAntrian(){
        foreach(Shipment::all() as $shipment){
            // dd($shipment->is_matched ==, $shipment->id_shipment_status == 4);
            if(!$shipment->is_matched && $shipment->id_shipment_status == 4){
                if($shipment->is_first_class) {
                    $daftar_barang = new DaftarBarangGold;
                } else {
                    $daftar_barang = new DaftarBarangRegular;
                }

                $daftar_barang->id_barang = $shipment->id;
                $shipment->is_matched = true;
                $shipment->save();
                $daftar_barang->save();
            }
        }
    }

    function get_all_shipment(){
        $this->CekDataAntrian();
        $result = array();
        foreach(DaftarBarangGold::where('is_assigned', 0)->get() as $barang){
            array_push($result, $barang->barang);
        }

        foreach(DaftarBarangRegular::where('is_assigned', 0)->get() as $barang){
            array_push($result, $barang->barang);
        }

        return response()->json(
            array(
                'err' => null,
                'result' => $result
            ), 200);
    }
}
