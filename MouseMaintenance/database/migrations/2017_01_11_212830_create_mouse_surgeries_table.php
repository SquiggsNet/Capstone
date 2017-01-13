<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMouseSurgeriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mouseSurgeries', function (Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('mouse_id');
            $table->foreign('mouse_id')->references('mouse_id')->on('mice');
            $table->unsignedInteger('surgery_id');
            $table->foreign('surgery_id')->references('surgery_id')->on('surgeries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
