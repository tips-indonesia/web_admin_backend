<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


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
        $p2 = Permission::create(['name' => 'receivedarrivalprocessingcenter.', 'show_name' => 'Received by Arrival Processing Center']);
        
    	// $role->givePermissionTo($p1);
    	$role->givePermissionTo($p2);
    }
}
