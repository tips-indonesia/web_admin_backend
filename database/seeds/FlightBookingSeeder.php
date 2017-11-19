<?php

use Illuminate\Database\Seeder;

class FlightBookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        for($i = 0; $i < 30 ; $i++) {
            $booking_code = $this->generateRandomString(9);
            $flight_code = $this->generateRandomString(5);
            $id_origin_airport = rand(1,7);
            $id_destination_airport = rand(1,7);

            if($id_destination_airport == $id_origin_airport) {
                $id_destination_airport = (($id_destination_airport+1) % 7) + 1;
            }
            DB::table('flight_booking_lists')->insert([
                'booking_code' => $booking_code,
                'id_airline' => 1,
                'id_origin_airport' => $id_origin_airport,
                'id_destination_airport' => $id_destination_airport,
                'depature' => '2017-11-29 12:20',
                'arrival' => '2017-11-29 13:20',
                'flight_code' => $flight_code,
            ]);
        }
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
