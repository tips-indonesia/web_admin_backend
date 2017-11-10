<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionTableSeeder extends Seeder
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
        Permission::create(['name' => 'citylists.']);
        Permission::create(['name' => 'airlineslists.']);
        Permission::create(['name' => 'airportlists.']);
        Permission::create(['name' => 'officelists.']);
        Permission::create(['name' => 'officetypes.']);
        Permission::create(['name' => 'banklists.']);
        Permission::create(['name' => 'paymenttypes.']);
        Permission::create(['name' => 'pricelists.']);
        Permission::create(['name' => 'insurances.']);
        Permission::create(['name' => 'weightlists.']);

        Permission::create(['name' => 'roles.']);
        Permission::create(['name' => 'users.']);
        Permission::create(['name' => 'permissions.']);
        $role = Role::all()->first();
        $permissions = Permission::all();
        foreach ($permissions as $permission) {
        	$role->givePermissionTo($permission);
        }

    }
}
