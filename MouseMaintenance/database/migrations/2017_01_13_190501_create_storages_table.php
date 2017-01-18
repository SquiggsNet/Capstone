<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoragesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('storages', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('tissue_id');
            $table->foreign('tissue_id')->references('tissue_id')->on('tissues');
            $table->boolean('type');
            $table->unsignedInteger('freezer')->nullable;
            $table->unsignedInteger('compartment')->nullable;
            $table->unsignedInteger('shelf')->nullable;
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
        Schema::drop('storages');
    }
}
