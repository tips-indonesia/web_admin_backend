<?php

use Illuminate\Database\Seeder;
use App\MenuList;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        MenuList::create([
            'name' => 'Master File',
            'class_name' => 'officetypes.|officelists.|citylists.|airlineslists.|airportlists.|banklists.|paymenttypes.|pricelists.|insurances.|weightlists.'
        ]);
            MenuList::create([
                'name' => 'City List',
                'menu_parent_id' => 1,
                'class_name' => 'citylists.'
            ]);
            MenuList::create([
                'name' => 'Airline List',
                'menu_parent_id' => 1,
                'class_name' => 'airlineslists.'
            ]);
            MenuList::create([
                'name' => 'Airport List',
                'menu_parent_id' => 1,
                'class_name' => 'airportlists.'
            ]);
            MenuList::create([
                'name' => 'Office List',
                'menu_parent_id' => 1,
                'class_name' => 'officetypes.|officelists.'
            ]);
                MenuList::create([
                    'name' => 'Office Type',
                    'menu_parent_id' => 5,
                    'class_name' => 'officetypes.'
                ]);
                MenuList::create([
                    'name' => 'Office List',
                    'menu_parent_id' => 5,
                    'class_name' => 'officelists.'
                ]);
            MenuList::create([
                'name' => 'Bank List',
                'menu_parent_id' => 1,
                'class_name' => 'banklists.'
            ]);  
            MenuList::create([
                'name' => 'Payment Type',
                'menu_parent_id' => 1,
                'class_name' => 'paymenttypes.'
            ]);  
            MenuList::create([
                'name' => 'Price List',
                'menu_parent_id' => 1,
                'class_name' => 'pricelists.'
            ]);  
            MenuList::create([
                'name' => 'Insurance',
                'menu_parent_id' => 1,
                'class_name' => 'insurances.'
            ]); 
            MenuList::create([
                'name' => 'Weight List',
                'menu_parent_id' => 1,
                'class_name' => 'weightlists.'
            ]);
        $transaction = MenuList::create([
            'name' => 'Transaction',
            'class_name' => 'shipments.'
        ]);
            MenuList::create([
                'name' => 'Shipment List',
                'menu_parent_id' => $transaction->id,
                'class_name' => 'shipments.'
            ]);
        $setting = MenuList::create([
            'name' => 'Setting',
            'class_name' => 'roles.|users.|shipmentstatuses.'
        ]);
            MenuList::create([
                'name' => 'Shipment Status',
                'menu_parent_id' => $setting->id,
                'class_name' => 'shipmentstatuses.'
            ]);
            $user = MenuList::create([
                'name' => 'User Application',
                'menu_parent_id' => $setting->id,
                'class_name' => 'roles.|users.'
            ]);
                MenuList::create([
                    'name' => 'Role List',
                    'menu_parent_id' => $user->id,
                    'class_name' => 'roles.'
                ]);
                MenuList::create([
                    'name' => 'User List',
                    'menu_parent_id' => $user->id,
                    'class_name' => 'users.'
                ]);
    }
}
