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


     //    MenuList::create([
     //        'name' => 'Promotions',
     //        'menu_parent_id' => 37,
     //        'class_name' => 'promotions.'
     //    ]);
        
        MenuList::create([
            'name' => 'Shipment Cancellation',
            'menu_parent_id' => 18,
            'class_name' => 'shipmentcancellation.'
        ]);
        // // $p3 = Permission::create(['name' => 'promotions.', 'show_name' => 'Promotions']);
        // $p4 = Permission::create(['name' => 'shipmentcancellation.', 'show_name' => 'Shipment Cancellation']);

        MenuList::create([
            'name' => 'Banner',
            'menu_parent_id' => 35,
            'class_name' => 'banner.'
        ]);

        MenuList::create([
            'name' => 'Referral',
            'menu_parent_id' => 35,
            'class_name' => 'referral.'
        ]);

        MenuList::create([
            'name' => 'Cron Timer',
            'menu_parent_id' => 35,
            'class_name' => 'crontimer.'
        ]);

        $p0 = Permission::create(['name' => 'shipmentcancellation.', 'show_name' => 'Shipment Cancellation']);
        $p1 = Permission::create(['name' => 'banner.', 'show_name' => 'Banner']);;
        $p2 = Permission::create(['name' => 'referral.', 'show_name' => 'Referral']);
        $p3 = Permission::create(['name' => 'crontimer.', 'show_name' => 'Cron Timer']);
        
    	// $role->givePermissionTo($p1);
    	$role = Role::all()->first();
        // $role->givePermissionTo($p3);
        $role->givePermissionTo($p0);
        $role->givePermissionTo($p1);
        $role->givePermissionTo($p2);
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

        //
        // DB::table('month_period')->insert([
        //     'nama' => 'Januari'
        // ]);
        // DB::table('month_period')->insert([
        //     'nama' => 'Februari'
        // ]);
        // DB::table('month_period')->insert([
        //     'nama' => 'Maret'
        // ]);
        // DB::table('month_period')->insert([
        //     'nama' => 'April'
        // ]);
        // DB::table('month_period')->insert([
        //     'nama' => 'Mei'
        // ]);
        // DB::table('month_period')->insert([
        //     'nama' => 'Juni'
        // ]);
        // DB::table('month_period')->insert([
        //     'nama' => 'Juli'
        // ]);
        // DB::table('month_period')->insert([
        //     'nama' => 'Agustus'
        // ]);
        // DB::table('month_period')->insert([
        //     'nama' => 'September'
        // ]);
        // DB::table('month_period')->insert([
        //     'nama' => 'Oktober'
        // ]);
        // DB::table('month_period')->insert([
        //     'nama' => 'November'
        // ]);
        // DB::table('month_period')->insert([
        //     'nama' => 'Desember'
        // ]);
        // DB::table('year_period')->insert([
        //     'year_period' => '2018'
        // ]);
        // DB::table('year_period')->insert([
        //     'year_period' => '2019'
        // ]);
        // DB::table('year_period')->insert([
        //     'year_period' => '2020'
        // ]);
    }
}
