<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\FlightBookingList;
use App\AirportList;

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
            $data = array(
                'err' => null,
                'result' => array(
                    'booking' => $booking,
                )
            );
        }

        return response()->json($data, 200);
    }
}
