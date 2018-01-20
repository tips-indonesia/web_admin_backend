<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $role = Role::create(['name'=>'admin']);
        $user = User::create(['first_name'=>'admin','last_name'=>'admin', 'username'=>'admin', 'password' => bcrypt('123123')]);
        $user->assignRole('admin');

    }
}
