<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFighterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fighter', function(Blueprint $table){
            $table->increments('id');
            $table->text('name');
            $table->text('vorname');
            $table->integer('gym_id')->unsigned();
            $table->timestamps();

            $table->foreign('gym_id')->references('id')->on('gym');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('fighter');
    }
}
