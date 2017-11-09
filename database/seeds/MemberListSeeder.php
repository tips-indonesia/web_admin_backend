<?php

use Illuminate\Database\Seeder;

class MemberListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('member_lists')->insert([
            'username' => 'test',
            'password' => bcrypt('password'),
            'registered_date' => \Carbon\Carbon::now(),
            'first_name' => 'Test First Name',
            'last_name' => 'Test Last Name',
            'birth_date' => '1990-01-01',
            'address' => 'Test Address',
            'mobile_phone_no' => '+62123456789',
            'email' => 'test@test.com',
            'id_city' => 1
        ]);
    }
}
