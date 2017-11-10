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
                'url' => route('citylists.index'),
                'class_name' => 'citylists.'
            ]);
            MenuList::create([
                'name' => 'Airline List',
                'menu_parent_id' => 1,
                'url' => route('airlineslists.index'),
                'class_name' => 'airlineslists.'
            ]);
            MenuList::create([
                'name' => 'Airport List',
                'menu_parent_id' => 1,
                'url' => route('airportlists.index'),
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
                    'url' => route('officetypes.index'),
                    'class_name' => 'officetypes.'
                ]);
                MenuList::create([
                    'name' => 'Office List',
                    'menu_parent_id' => 5,
                    'url' => route('officelists.index'),
                    'class_name' => 'officelists.'
                ]);
            MenuList::create([
                'name' => 'Bank List',
                'menu_parent_id' => 1,
                'url' => route('banklists.index'),
                'class_name' => 'banklists.'
            ]);  
            MenuList::create([
                'name' => 'Payment Type',
                'menu_parent_id' => 1,
                'url' => route('paymenttypes.index'),
                'class_name' => 'paymenttypes.'
            ]);  
            MenuList::create([
                'name' => 'Price List',
                'menu_parent_id' => 1,
                'url' => route('pricelists.index'),
                'class_name' => 'pricelists.'
            ]);  
            MenuList::create([
                'name' => 'Insurance',
                'menu_parent_id' => 1,
                'url' => route('insurances.index'),
                'class_name' => 'insurances.'
            ]); 
            MenuList::create([
                'name' => 'Weight List',
                'menu_parent_id' => 1,
                'url' => route('weightlists.index'),
                'class_name' => 'weightlists.'
            ]);    
        MenuList::create([
            'name' => 'Setting',
            'class_name' => 'roles.|users.|shipmentstatuses.'
        ]);
            MenuList::create([
                'name' => 'Shipment Status',
                'menu_parent_id' => 13,
                'url' => route('shipmentstatuses.index'),
                'class_name' => 'shipmentstatuses.'
            ]);
            MenuList::create([
                'name' => 'User Application',
                'menu_parent_id' => 13,
                'class_name' => 'roles.|users.'
            ]);
                MenuList::create([
                    'name' => 'Role List',
                    'menu_parent_id' => 15,
                    'url' => route('roles.index'),
                    'class_name' => 'roles.'
                ]);
                MenuList::create([
                    'name' => 'User List',
                    'menu_parent_id' => 15,
                    'url' => route('users.index'),
                    'class_name' => 'users.'
                ]);
    }
}
