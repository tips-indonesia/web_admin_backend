<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKeberangkatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keberangkatans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_tipster');
            $table->string('asal');
            $table->string('tujuan');
            $table->dateTime('dt_berangkat');
            $table->boolean('is_full')->default(false);
            $table->integer('berat_tersedia');
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
        Schema::dropIfExists('keberangkatans');
    }
}
