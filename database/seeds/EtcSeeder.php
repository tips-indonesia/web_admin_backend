<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

use App\MenuList;


class EtcSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // app()['cache']->forget('spatie.permission.cache');

        // $p1 = Permission::create(['name' => 'deliveryshipment.', 'show_name' => 'Delivery Shipment']);
        // $p2 = Permission::create(['name' => 'receivedarrivalprocessingcenter.', 'show_name' => 'Received by Arrival Processing Center']);
        $p3 = Permission::create(['name' => 'tipsterpayments.', 'show_name' => 'Tipster Payment']);
        
    	// $role->givePermissionTo($p1);
    	$role = Role::all()->first();
    	$role->givePermissionTo($p3);


        // MenuList::create([
        //     'name' => 'Received by Arrival Processing Center',
        //     'menu_parent_id' => 18,
        //     'class_name' => 'receivedarrivalprocessingcenter.'
        // ]);

        //     MenuList::create([
        //         'name' => 'Delivery Shipment',
        //         'menu_parent_id' => 18,
        //         'class_name' => 'deliveryshipment.'
        //     ]);
    }
}
