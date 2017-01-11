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
            $table->integer('mc_id');
            $table->foreign('mc_id')->references('id')->on('colonies');
            $table->integer('m_reserved')->nullable;
            $table->boolean('m_geno_type_a');
            $table->boolean('m_geno_type_b');
            $table->date('m_birth_date');
            $table->decimal('m_weight', 4,2);
            $table->string('m_cage');
            $table->text('m_comments');
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
