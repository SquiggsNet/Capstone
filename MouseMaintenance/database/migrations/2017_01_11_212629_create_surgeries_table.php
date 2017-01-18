<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurgeriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surgeries', function (Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable;
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->date('scheduled_date');
            $table->string('purpose');
            $table->string('comments');
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
