<?php

use Illuminate\Database\Seeder;

class BankTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('bank_lists')->insert([
            'name' => 'BRI',
        ]);

        DB::table('bank_lists')->insert([
            'name' => 'BCA',
        ]);

        DB::table('bank_card_lists')->insert([
            'id_bank' => 1,
            'name' => 'Aprilia',
            'card_number' => '7771-1213-131'
        ]);

        DB::table('bank_card_lists')->insert([
            'id_bank' => 1,
            'name' => 'Liem',
            'card_number' => '2133-1233-090'
        ]);

        DB::table('bank_card_lists')->insert([
            'id_bank' => 2,
            'name' => 'Sintia',
            'card_number' => '111-133-0900'
        ]);
    }
}
