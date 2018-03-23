<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ViewUserMemberlist extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE VIEW v_member_employee AS
                select id, username as mobile_phone_no, password, 'Y' as is_employee
                from users
                union all
                select id, mobile_phone_no, password, 'N' as is_employee
                from member_lists");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW IF EXISTS v_member_employee');
    }
}
