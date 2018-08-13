<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFavoriteAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favorite_address', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('is_pengirim_penerima');
            $table->integer('id_member');
            $table->string('keterangan_tempat', 191)->unique();
            $table->string('first_name', 191);
            $table->string('last_name', 191);
            $table->string('mobile_phone_no', 191);
            $table->string('address', 191);
            $table->string('address_detail', 191);
            $table->integer('id_province');
            $table->integer('id_city');
            $table->integer('id_district');
            $table->string('postal_code', 191);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('favorite_address');
    }
}
