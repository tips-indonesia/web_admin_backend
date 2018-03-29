<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\MemberList;

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
        $user = MemberList::create([
            'first_name' => 'test',
            'last_name' => 'test',
            'password' => bcrypt('123'),
            'registered_date' => \Carbon\Carbon::now(),
            'birth_date' => '1990-01-01',
            'address' => 'Test Address',
            'mobile_phone_no' => '+621',
            'email' => 'test@test.com',
            'id_city' => 1
        ]);
        $user->assignRole('admin');
    }
}
