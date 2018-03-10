<?php

use Illuminate\Database\Seeder;

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
        app()['cache']->forget('spatie.permission.cache');

        Permission::create(['name' => 'deliveryshipment.', 'show_name' => 'Delivery Shipment']);
        Permission::create(['name' => 'receivedarrivalprocessingcenter.', 'show_name' => 'Received by Arrival Processing Center']);
        
        $role = Role::all()->first();
        $permissions = Permission::all();
        foreach ($permissions as $permission) {
        	$role->givePermissionTo($permission);
        }
    }
}
