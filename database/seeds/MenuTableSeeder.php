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
            'name' => 'Master File',
            'class_name' => '*'
        ]);
            MenuList::create([
                'name' => 'Region List',
                'menu_parent_id' => 1,
                'class_name' => '*'
            ]);
                MenuList::create([
                    'name' => 'Province List',
                    'menu_parent_id' => 2,
                    'class_name' => 'provincelists.'
                ]);
                MenuList::create([
                    'name' => 'City List',
                    'menu_parent_id' => 2,
                    'class_name' => 'citylists.'
                ]);
                MenuList::create([
                    'name' => 'Subdistrict List',
                    'menu_parent_id' => 2,
                    'class_name' => 'subdistrictlists.'
                ]);
            MenuList::create([
                'name' => 'Airline List',
                'menu_parent_id' => 1,
                'class_name' => 'airlineslists.'
            ]);
            MenuList::create([
                'name' => 'Airport List',
                'menu_parent_id' => 1,
                'class_name' => 'airportlists.'
            ]);
            MenuList::create([
                'name' => 'Airportcity List',
                'menu_parent_id' => 1,
                'class_name' => 'airportcitylists.'
            ]);
            MenuList::create([
                'name' => 'Office List',
                'menu_parent_id' => 1,
                'class_name' => '*'
            ]);
                MenuList::create([
                    'name' => 'Office Type',
                    'menu_parent_id' => 9,
                    'class_name' => 'officetypes.'
                ]);
                MenuList::create([
                    'name' => 'Office List',
                    'menu_parent_id' => 9,
                    'class_name' => 'officelists.'
                ]);
            MenuList::create([
                'name' => 'Bank List',
                'menu_parent_id' => 1,
                'class_name' => 'banklists.'
            ]);  
            MenuList::create([
                'name' => 'Payment Type',
                'menu_parent_id' => 1,
                'class_name' => 'paymenttypes.'
            ]);  
            MenuList::create([
                'name' => 'Price List',
                'menu_parent_id' => 1,
                'class_name' => 'pricelists.'
            ]);  
            MenuList::create([
                'name' => 'Member List',
                'menu_parent_id' => 1,
                'class_name' => 'memberlists.'
            ]);
            MenuList::create([
                'name' => 'Insurance',
                'menu_parent_id' => 1,
                'class_name' => 'insurances.'
            ]); 
            MenuList::create([
                'name' => 'Weight List',
                'menu_parent_id' => 1,
                'class_name' => 'weightlists.'
            ]);
        $transaction = MenuList::create([
            'name' => 'Transaction',
            'class_name' => '*'
        ]);
            // MenuList::create([
            //     'name' => 'Shipment List',
            //     'menu_parent_id' => $transaction->id,
            //     'class_name' => 'shipments.'
            // ]);
            MenuList::create([
                'name' => 'Slot List',
                'menu_parent_id' => $transaction->id,
                'class_name' => 'slotlists.'
            ]);
            MenuList::create([
                'name' => 'Packaging Slot',
                'menu_parent_id' => $transaction->id,
                'class_name' => 'packagingslots.'
            ]);
            MenuList::create([
                'name' => 'Delivery to Processing Center',
                'menu_parent_id' => $transaction->id,
                'class_name' => 'deliveries.'
            ]);
            // MenuList::create([
            //     'name' => 'Processing Center Package List',
            //     'menu_parent_id' => $transaction->id,
            //     'class_name' => 'packagingprocessingcenters.'
            // ]);
            MenuList::create([
                'name' => 'Received by Processing Center',
                'menu_parent_id' => $transaction->id,
                'class_name' => 'receiveds.'
            ]);
            MenuList::create([
                'name' => 'Shipment Tracking',
                'menu_parent_id' => $transaction->id,
                'class_name' => 'shipmenttrackings.'
            ]);
            MenuList::create([
                'name' => 'Packaging Rest Shipment',
                'menu_parent_id' => $transaction->id,
                'class_name' => 'packagingrestshipments.'
            ]);
            MenuList::create([
                'name' => 'Shipment Drop Off List',
                'menu_parent_id' => $transaction->id,
                'class_name' => 'shipmentdropoffs.'
            ]);
            MenuList::create([
                'name' => 'Shipment Pick Up List',
                'menu_parent_id' => $transaction->id,
                'class_name' => 'shipmentpickups.'
            ]);
            MenuList::create([
                'name' => 'Shipment Matching Monitor',
                'menu_parent_id' => $transaction->id,
                'class_name' => 'shipmentmatchingmonitors.'
            ]);
            MenuList::create([
                'name' => 'Delivery Package to Departure Counter',
                'menu_parent_id' => $transaction->id,
                'class_name' => 'deliverydeparturecounters.'
            ]);
            MenuList::create([
                'name' => 'Pending Package at Departure Counter',
                'menu_parent_id' => $transaction->id,
                'class_name' => 'pendingdeparturecounters.'
            ]);
            MenuList::create([
                'name' => 'Pending Package at Arrival Counter',
                'menu_parent_id' => $transaction->id,
                'class_name' => 'pendingarrivalcounters.'
            ]);
            MenuList::create([
                'name' => 'Delivery Packaging to Arrival Processing Center',
                'menu_parent_id' => $transaction->id,
                'class_name' => 'deliveryprocessingcenters.'
            ]);
            MenuList::create([
                'name' => 'Receive Packaging from Arrival Processing Center',
                'menu_parent_id' => $transaction->id,
                'class_name' => 'receiveprocessingcenters.'
            ]);
        $setting = MenuList::create([
            'name' => 'Setting',
            'class_name' => '*'
        ]);
            MenuList::create([
                'name' => 'Term and Agreement',
                'menu_parent_id' => $setting->id,
                'class_name' => 'terms.'
            ]);
            MenuList::create([
                'name' => 'Shipment Status',
                'menu_parent_id' => $setting->id,
                'class_name' => 'shipmentstatuses.'
            ]);
            $user = MenuList::create([
                'name' => 'Tipster Milestone',
                'menu_parent_id' => $setting->id,
                'class_name' => 'tipstermilestones.'
            ]);
            $user = MenuList::create([
                'name' => 'User Application',
                'menu_parent_id' => $setting->id,
                'class_name' => '*'
            ]);
                MenuList::create([
                    'name' => 'Role List',
                    'menu_parent_id' => $user->id,
                    'class_name' => 'roles.'
                ]);
                MenuList::create([
                    'name' => 'User List',
                    'menu_parent_id' => $user->id,
                    'class_name' => 'users.'
                ]);

        $utility = MenuList::create([
            'name' => 'Utility',
            'class_name' => 'backups.'
        ]); 
            MenuList::create([
                'name' => 'Backup Database',
                'menu_parent_id' => $utility->id,
                'class_name' => 'backups.'
            ]);
    }
}
