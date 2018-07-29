<?php

namespace App\Http\Controllers\API;

use App\AirportcityList;
use App\AirlinesList;
use App\SlotList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\FlightBookingList;
use App\AirportList;
use App\CityList;
use App\PriceList;

class FlightController extends Controller
{
    //
    function get_flight_booking(Request $request) {
        $booking_code = $request->booking_code;
        $booking = FlightBookingList::where('booking_code', $booking_code)->first();

        if($booking == null) {
            $data = array(
                'err' => [
                    'code' => 0,
                    'message' => 'Kode Booking tidak ditemukan'
                ],
                'result' => null
            );

        } else {
            $booking->origin_airport = AirportList::find($booking->id_origin_airport);
            $booking->destination_airport = AirportList::find($booking->id_destination_airport);
            $booking->origin_city = CityList::find($booking->origin_airport->id_city)->name;
            $booking->destination_city = CityList::find($booking->destination_airport->id_city)->name;
            $data = array(
                'err' => null,
                'result' => array(
                    'booking' => $booking,
                )
            );
        }

        return response()->json($data, 200);
    }


    public static function get_airport_by_code($code){
        return AirportList::where("initial_code", substr($code, 0, 3))->first();
    }

    public static function create_new_empty_booking(){
        return FlightBookingList::create([]);
    }

    public static function create_new_booking($booking_code, $code_origin, $code_destination, $date_origin, $flight_code){
        $airport_origin = FlightController::get_airport_by_code($code_origin);
        $airport_destination = FlightController::get_airport_by_code($code_destination);

        if(!$airport_origin || !$airport_destination){
            // return false; // Airport asal atau tujuan tidak ditemukan // deprecated

            $booking = FlightBookingList::create(array(
                'booking_code' => $booking_code,
                'id_airline' => 1,
                'depature' => $date_origin,
                'flight_code' => $flight_code,
            ));
        }else{
            $booking = FlightBookingList::create(array(
                'booking_code' => $booking_code,
                'id_airline' => 1,
                'id_origin_airport' => $airport_origin->id,
                'id_destination_airport' => $airport_destination->id,
                'depature' => $date_origin,
                'flight_code' => $flight_code ? $flight_code : "-",
            ));
        }

        $booking->origin_airport = AirportList::find($booking->id_origin_airport);
        $booking->destination_airport = AirportList::find($booking->id_destination_airport);
        $booking->origin_city = AirportcityList::find($booking->origin_airport->id_city)->name;
        $booking->destination_city = AirportcityList::find($booking->destination_airport->id_city)->name;

        return $booking;
    }

    function post_flight_booking_code(Request $request){

        if($request->booking_id){
            $booking = FlightBookingList::find($request->booking_id);
            $booking->origin_airport = AirportList::find($booking->id_origin_airport);
            $booking->destination_airport = AirportList::find($booking->id_destination_airport);
            $booking->origin_city = AirportcityList::find($booking->origin_airport->id_city)->name;
            $booking->destination_city = AirportcityList::find($booking->destination_airport->id_city)->name;

            $price = PriceList::where('id_origin_city', $booking->origin_airport->id_city)
                            ->where('id_destination_city', $booking->destination_airport->id_city)
                            ->first();

            if(!$price){
                $data = array(
                    'err' => [
                        'code' => 500,
                        'message' => 'Harga Penerbangan dari ' . $booking->origin_city->name . ' ke ' . 
                                     $booking->destination_city->name . ' tidak tersedia'
                    ],
                    'result' => null
                );

                return response()->json($data, 200);
            }

            $booking->tipster_price = $price->tipster_price;
            if($booking){
                $data = array(
                    'err' => null,
                    'result' => array(
                        'booking' => $booking,
                    )
                );

                return response()->json($data, 200);
            }
        }

        if($request->code_origin == $request->code_destination){
            $data = array(
                'err' => [
                    'code' => 400,
                    'message' => 'airport awal dan akhir tidak boleh sama'
                ],
                'result' => null
            );
            
            return response()->json($data, 200);
        }


        $prefix_fc = substr($request->flight_code, 0, 2);
        $airline = AirlinesList::where('prefix_flight_code', $prefix_fc)->where('status', 1)->first();

        $max_index_fc = sizeof($request->flight_code) - 1;
        $number_fc = substr($request->flight_code, 2 - $max_index_fc);

        if(!$airline){
            $data = array(
                'err' => [
                    'code' => 404,
                    'message' => 'Maskapai yang Anda pilih belum di dukung saat ini'
                ],
                'result' => null
            );
            
            return response()->json($data, 200);
        }

        if(!is_numeric($number_fc)){
            $data = array(
                'err' => [
                    'code' => 404,
                    'message' => 'Kode penerbangan ' . $request->flight_code . ' tidak valid'
                ],
                'result' => null
            );
            
            return response()->json($data, 200);
        }

        // create new booking record
        $new_booking = FlightController::create_new_booking($request->booking_code, $request->code_origin, 
            $request->code_destination, $request->date_origin, $request->flight_code);

        // DUPLIKATTT dengan FlightController@post_flight_booking_code 
        $price = PriceList::where('id_origin_city', $new_booking->origin_airport->id_city)
                        ->where('id_destination_city', $new_booking->destination_airport->id_city)
                        ->first();

        // DUPLIKATTT dengan FlightController@post_flight_booking_code 
        if(!$price){
            $data = array(
                'err' => [
                    'code' => 500,
                    'message' => 'Harga Penerbangan dari ' . $new_booking->origin_city->name . ' ke ' . 
                                 $new_booking->destination_city->name . ' tidak tersedia'
                ],
                'result' => null
            );

            return response()->json($data, 200);
        }

        // DUPLIKATTT dengan FlightController@post_flight_booking_code 
        $new_booking->tipster_price = $price->tipster_price;

        if(!$new_booking){
            $data = array(
                'err' => [
                    'code' => 404,
                    'message' => 'Airport asal atau tujuan tidak ditemukan'
                ],
                'result' => null
            );

            return response()->json($data, 200);
        }

        $data = array(
            'err' => null,
            'result' => array(
                'booking' => $new_booking,
            )
        );

        return response()->json($data, 200);
    }

    public function test(Request $request){
        
    }

    function get_booking_code_by_city(Request $request) {
        $airport_origin_init = AirportList::select('id')->where('id_city',$request->id_city_origin)->get();
        $airport_destination_init = AirportList::select('id')->where('id_city',$request->id_city_destination)->get();
        $airport_origin = [];
        $airport_destination = [];

        foreach ($airport_origin_init as $airport) {
            array_push($airport_origin, $airport->id);
        }

        foreach ($airport_destination_init as $airport) {
            array_push($airport_destination, $airport->id);
        }

        $booking_init = FlightBookingList::whereIn('id_origin_airport', $airport_origin)->whereIn('id_destination_airport', $airport_destination)->get();
        $code_booking = [];
        foreach ($booking_init as $booking) {
            array_push($code_booking, $booking->booking_code);
        }

        return response()->json($code_booking, 200);
    }

    function get_used_booking_code() {
        $booking_init = SlotList::all();

        $code_booking = [];
        foreach ($booking_init as $booking) {
            array_push($code_booking, $booking->booking_code);
        }

        return response()->json($code_booking, 200);
    }

    function airport_list(){
        $airport_list_init = AirportList::all();
        $airport_list = [];

        foreach ($airport_list_init as $airport) {
            $airport->city_name = AirportcityList::find($airport->id_city)->name;
            array_push($airport_list, $airport);
        }

        return $airport_list;
    }

    function get_airport_list(){
        $data = array(
            'err' => null,
            'result' => array(
                'airport_list' => $this->airport_list(),
            )
        );

        return response()->json($data, 200);

    }

    public static function getAirlineNameOfFlightCode($flight_code){
        $prefix_fc = substr($flight_code, 0, 2);
        $airline = AirlinesList::where('prefix_flight_code', $prefix_fc)->where('status', 1)->first();
        if($airline)
            return $airline->name;
        
        return "";
    }

    public static function getAirlineIdOfFlightCode($flight_code){
        $prefix_fc = substr($flight_code, 0, 2);
        $airline = AirlinesList::where('prefix_flight_code', $prefix_fc)->where('status', 1)->first();
        if($airline)
            return $airline->id;
        
        return "";
    }

    function flight_booking_code_check(Request $request){
        $flight_code = $request->code;
        if(!$flight_code){
            $data = array(
                'err' => [
                    'code' => 400,
                    'message' => 'Parameter code wajib diisi'
                ],
                'result' => null
            );

            return response()->json($data, 200);
        }

        $prefix_fc = substr($flight_code, 0, 2);
        $airline = AirlinesList::where('prefix_flight_code', $prefix_fc)->where('status', 1)->first();

        if($airline){
            $data = array(
                'err' => null,
                'result' => array(
                    'status' => true,
                )
            );
        }else{
            $data = array(
                'err' => [
                    'code' => 404,
                    'message' => 'Maskapai yang Anda pilih belum kami support sementara ini'
                ],
                'result' => null
            );
        }

        return response()->json($data, 200);

    }
}
