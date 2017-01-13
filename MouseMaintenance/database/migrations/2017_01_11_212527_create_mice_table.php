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
            $table->foreign('colony_id')->references('colony_id')->on('colonies');
            $table->unsignedInteger('cage_id');
            $table->foreign('cage_id')->references('cage_id')->on('cages');
            $table->unsignedInteger('reserved_for')->nullable;
            $table->foreign('reserved_for')->references('user_id')->on('users');
            $table->boolean('geno_type_a')->nullable;
            $table->boolean('geno_type_b')->nullable;
            //pedigree needs to be added!!
            $table->date('birth_date');
            $table->date('end_date')->nullable;
            $table->decimal('weight', 4,2);
            $table->string('cage');
            $table->text('comments');
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
