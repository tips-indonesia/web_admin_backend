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
            'name' => 'Master File'
        ]);
            MenuList::create([
                'name' => 'Region List',
                'menu_parent_id' => 1
            ]);
                MenuList::create([
                    'name' => 'Country List',
                    'menu_parent_id' => 2,
                    'url' => route('countrylists.index'),
                    'class_name' => 'countrylists.'
                ]);
                MenuList::create([
                    'name' => 'Province List',
                    'menu_parent_id' => 2,
                    'url' => route('provincelists.index'),
                    'class_name' => 'provincelists.'
                ]);
                MenuList::create([
                    'name' => 'City List',
                    'menu_parent_id' => 2,
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
            'menu_parent_id' => 1
        ]);
            MenuList::create([
                'name' => 'Office Type',
                'menu_parent_id' => 8,
                'url' => route('officetypes.index'),
                'class_name' => 'officetypes.'
            ]);
            MenuList::create([
                'name' => 'Office List',
                'menu_parent_id' => 8,
                'url' => route('officelists.index'),
                'class_name' => 'officelists.'
            ]);
        MenuList::create([
            'name' => 'Setting'
        ]);
            MenuList::create([
                'name' => 'Role List',
                'menu_parent_id' => 11,
                'url' => route('roles.index'),
                'class_name' => 'roles.'
            ]);
            MenuList::create([
                'name' => 'User List',
                'menu_parent_id' => 11,
                'url' => route('users.index'),
                'class_name' => 'users.'
            ]);
    }
}
