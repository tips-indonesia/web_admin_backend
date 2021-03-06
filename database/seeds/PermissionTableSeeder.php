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

        // Master File
            // Region List
            Permission::create(['name' => 'citylists.', 'show_name' => 'City List']);
            Permission::create(['name' => 'provincelists.', 'show_name' => 'Province List']);
            Permission::create(['name' => 'subdistrictlists.', 'show_name' => 'Subdistrict List']);
            // End of Region List
        Permission::create(['name' => 'airlineslists.', 'show_name' => 'Airline List']);
        Permission::create(['name' => 'airportlists.', 'show_name' => 'Airport List']);
        Permission::create(['name' => 'airportcitylists.', 'show_name' => 'Airportcity List']);
            // Office List
            Permission::create(['name' => 'officelists.', 'show_name' => 'Office List']);
            Permission::create(['name' => 'officetypes.', 'show_name' => 'Office Type']);
            // End of Office List
        Permission::create(['name' => 'banklists.', 'show_name' => 'Bank List']);
        Permission::create(['name' => 'paymenttypes.', 'show_name' => 'Payment Type']);
        Permission::create(['name' => 'pricelists.', 'show_name' => 'Price List']);
        Permission::create(['name' => 'insurances.', 'show_name' => 'Insurance']);
        Permission::create(['name' => 'memberlists.', 'show_name' => 'Member List']);
        Permission::create(['name' => 'weightlists.', 'show_name' => 'Weight List']);
        // End of Master File

        // Transaction
        Permission::create(['name' => 'shipments.', 'show_name' => 'Shipment List']);
        Permission::create(['name' => 'slotlists.', 'show_name' => 'Slot List']);
        Permission::create(['name' => 'match.', 'show_name' => 'Manual Matching']); 
        Permission::create(['name' => 'packagingslots.', 'show_name' => 'Packaging Slot']);
        Permission::create(['name' => 'deliveries.', 'show_name' => 'Shipment Delivery to Processing Center']);
        Permission::create(['name' => 'deliveryshipment.', 'show_name' => 'Delivery Shipment']);
        Permission::create(['name' => 'receiveds.', 'show_name' => 'Shipment Received by Processing Center']);
        Permission::create(['name' => 'shipmenttrackings.', 'show_name' => 'Shipment Tracking']);
        Permission::create(['name' => 'packagingprocessingcenters.', 'show_name' => 'Processing Center Package List']);
        Permission::create(['name' => 'packagingrestshipments.', 'show_name' => 'Packaging Rest Shipment']);
        Permission::create(['name' => 'receivedarrivalprocessingcenter.', 'show_name' => 'Received by Arrival Processing Center']);
        Permission::create(['name' => 'shipmentpickups.', 'show_name' => 'Shipment Pick Up']);
        Permission::create(['name' => 'tipsterpayments.', 'show_name' => 'Tipster Payment']);
        Permission::create(['name' => 'shipmentdropoffs.', 'show_name' => 'Shipment Drop Off']);
        Permission::create(['name' => 'deliverydeparturecounters.', 'show_name' => 'Delivery Package to Departure Counter']);
        Permission::create(['name' => 'deliveryprocessingcenters.', 'show_name' => 'Delivery Packaging to Arrival Processing Center']);
        Permission::create(['name' => 'receiveprocessingcenters.', 'show_name' => 'Receive Packaging from Processing Center']);
        Permission::create(['name' => 'shipmentcancellation.', 'show_name' => 'Shipment Cancellation']);
        Permission::create(['name' => 'shipmentrejection.', 'show_name' => 'Shipment Rejection']);
        // End of Transaction


        // Setting
        Permission::create(['name' => 'shipmentstatuses.', 'show_name' => 'Shipment Status']);
        Permission::create(['name' => 'terms.', 'show_name' => 'Term and Agreement']); 
        Permission::create(['name' => 'tipstermilestones.', 'show_name' => 'Tipster Milestone']);
        Permission::create(['name' => 'banner.', 'show_name' => 'Banner']);
        Permission::create(['name' => 'promotions.', 'show_name' => 'Promotions']);
        Permission::create(['name' => 'referral.', 'show_name' => 'Referral']);
        Permission::create(['name' => 'crontimer.', 'show_name' => 'Cron Timer']);
        Permission::create(['name' => 'promotiontext.', 'show_name' => 'Promotion Text']);
        Permission::create(['name' => 'addworkerability.', 'show_name' => 'Adding Worker Ability to User']);
        Permission::create(['name' => 'redeem.', 'show_name' => 'Redeem']);

            // User 
            Permission::create(['name' => 'roles.', 'show_name' => 'Role List']);
            Permission::create(['name' => 'users.', 'show_name' => 'User List']);
            Permission::create(['name' => 'permissions.', 'show_name' => 'Permission Management']);
            // End of User
        // End of Setting

        // Utility
        Permission::create(['name' => 'backups.', 'show_name' => 'Backup Database']);  
        
        $role = Role::all()->first();
        $permissions = Permission::all();
        foreach ($permissions as $permission) {
        	$role->givePermissionTo($permission);
        }

    }
}
