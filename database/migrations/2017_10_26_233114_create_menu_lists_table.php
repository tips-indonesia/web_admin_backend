<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('class_name')->nullable();
            $table->string('url')->default('#');
            $table->string('image_url')->default('https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png');
            $table->unsignedInteger('menu_parent_id')->nullable();
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
        Schema::dropIfExists('menu_lists');
    }
}
