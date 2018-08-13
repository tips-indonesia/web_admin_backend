<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

use App\MenuList;
class Menu810 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MenuList::create([
            'name' => 'Shipment Rejection',
            'menu_parent_id' => 18,
            'class_name' => 'shipmentrejection.'
        ]);

        MenuList::create([
            'name' => 'Shipment Rejection Delivery',
            'menu_parent_id' => 18,
            'class_name' => 'shipmentrejectiondelivery.'
        ]);

        MenuList::create([
            'name' => 'Slot Rejection',
            'menu_parent_id' => 18,
            'class_name' => 'slotrejection.'
        ]);

        $a = Permission::create(['name' => 'shipmentrejection.', 'show_name' => 'Shipment Rejection']);
        $b = Permission::create(['name' => 'shipmentrejectiondelivery.', 'show_name' => 'Shipment Rejection Delivery']);
        $c = Permission::create(['name' => 'slotrejection.', 'show_name' => 'Slot Rejection']);
        
        $role = Role::all()->first();

        $role->givePermissionTo($a);
        $role->givePermissionTo($b);
        $role->givePermissionTo($c); 
    }
}
