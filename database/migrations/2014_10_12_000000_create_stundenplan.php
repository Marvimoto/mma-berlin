<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStundenplan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainer', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('stundenplan', function (Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->date('valid_from');
            $table->date('valid_until');
            $table->timestamps();
        });
        Schema::create('kurs', function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('kursplan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('stundenplan_id')->unsigned();
            $table->integer('kurs_id')->unsigned();
            $table->integer('trainer_id')->unsigned();
            $table->time('begins_at');
            $table->time('ends_at');
            $table->timestamps();

            $table->foreign('stundenplan_id')->references('id')->on('stundenplan');
            $table->foreign('kurs_id')->references('id')->on('kurs');
            $table->foreign('trainer_id')->references('id')->on('trainer');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
        Schema::drop('stundenplan');
        Schema::drop('kurs');
        Schema::drop('kursplan');
    }
}
