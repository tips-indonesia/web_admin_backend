<?php

namespace App\Http\Controllers\API;

use App\AirportcityList;
use App\SlotList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\FlightBookingList;
use App\AirportList;
use App\CityList;

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

    function get_airport_list() {
        $airport_list_init = AirportList::all();
        $airport_list = [];

        foreach ($airport_list_init as $airport) {
            $airport->city_name = AirportcityList::find($airport->id_city)->name;
            array_push($airport_list, $airport);
        }

        $data = array(
            'err' => null,
            'result' => array(
                'airport_list' => $airport_list,
            )
        );

        return response()->json($data, 200);

    }
}
