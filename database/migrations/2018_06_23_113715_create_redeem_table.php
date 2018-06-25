<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRedeemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('redeem', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description', 191);
            $table->date('start_date');
            $table->date('end_date');
            $table->string('file_name', 191);
            $table->string('remarks', 191);
            $table->string('url', 191);
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
        Schema::dropIfExists('redeem');
    }
}
