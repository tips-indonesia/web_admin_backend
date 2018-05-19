<?php

use Illuminate\Database\Seeder;
use App\WalletTransaction;

class WalletTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WalletTransaction::create([
        	'id'			=> 1,
        	'description'	=> "ANTAR"
        ]);
        WalletTransaction::create([
        	'id'			=> 2,
        	'description'	=> "KIRIM"
        ]);
        WalletTransaction::create([
        	'id'			=> 3,
        	'description'	=> "BAYAR CASH"
        ]);
        WalletTransaction::create([
        	'id'			=> 4,
        	'description'	=> "REFFERAL"
        ]);
        WalletTransaction::create([
        	'id'			=> 5,
        	'description'	=> "REFFERED"
        ]);
        WalletTransaction::create([
        	'id'			=> 6,
        	'description'	=> "REDEEM"
        ]);
    }
}
