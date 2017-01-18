<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mice', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('colony_id');
            $table->foreign('colony_id')->references('id')->on('colonies');
            $table->unsignedInteger('reserved_for')->nullable;
            $table->foreign('reserved_for')->references('id')->on('users');
            $table->boolean('geno_type_a')->nullable;
            $table->boolean('geno_type_b')->nullable;
            $table->unsignedInteger('father');
            $table->unsignedInteger('mother_one');
            $table->unsignedInteger('mother_two');
            $table->date('birth_date');
            $table->date('wean_date')->nullable;
            $table->date('end_date')->nullable;
            $table->boolean('sick_report');
            $table->text('comments')->nullable;
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
