<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('asal');
            $table->string('tujuan');
            $table->string('jenis');
            $table->integer('berat');
            $table->string('status_barang')->default('PENDING');
            $table->integer('id_keberangkatan')->unsigned()->nullable();
            $table->foreign('id_keberangkatan')->references('id')->on('keberangkatans')->onDelete('cascade');
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
        Schema::dropIfExists('barangs');
    }
}
