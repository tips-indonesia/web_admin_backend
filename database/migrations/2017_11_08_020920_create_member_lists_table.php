<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email');
            $table->string('password')->nullable();
            $table->string('mobile_phone_no')->nullable();
            $table->date('registered_date');
            $table->string('profil_picture')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('address')->nullable();
            $table->boolean('status')->default(true);
            $table->unsignedInteger('id_city')->nullable();
            $table->string('token')->nullable();
            $table->string('fb_token', 512)->nullable();
            $table->string('twitter_token', 512)->nullable();
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
        Schema::dropIfExists('member_lists');
    }
}
