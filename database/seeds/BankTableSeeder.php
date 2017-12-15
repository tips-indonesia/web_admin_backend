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
            'name' => 'Aprilia'
        ]);

        DB::table('bank_card_lists')->insert([
            'id_bank' => 1,
            'name' => 'Liem'
        ]);

        DB::table('bank_card_lists')->insert([
            'id_bank' => 2,
            'name' => 'Sintia'
        ]);
    }
}
