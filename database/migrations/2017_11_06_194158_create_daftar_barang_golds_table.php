<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDaftarBarangGoldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daftar_barang_golds', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_barang')->unsigned();
            $table->foreign('id_barang')->references('id')->on('shipments')->onDelete('cascade');
            $table->boolean('is_assigned')->default(false);
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
        Schema::dropIfExists('daftar_barang_golds');
    }
}
