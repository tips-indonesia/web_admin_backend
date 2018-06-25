<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

use App\MenuList;

class EtcSeederMenu extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MenuList::create([
            'name' => 'Promotion Text',
            'menu_parent_id' => 34,
            'class_name' => 'promotiontext.'
        ]);

        MenuList::create([
            'name' => 'Adding Worker Ability to User',
            'menu_parent_id' => 34,
            'class_name' => 'addworkerability.'
        ]);

        MenuList::create([
            'name' => 'Redeem',
            'menu_parent_id' => 34,
            'class_name' => 'redeem.'
        ]);
        $a = Permission::create(['name' => 'promotiontext.', 'show_name' => 'Promotion Text']);
        $b = Permission::create(['name' => 'addworkerability.', 'show_name' => 'Adding Worker Ability to User']);
        $c = Permission::create(['name' => 'redeem.', 'show_name' => 'Redeem']);
        
    	$role = Role::all()->first();

        $role->givePermissionTo($a);
        $role->givePermissionTo($b);
        $role->givePermissionTo($c); 
    }
}
