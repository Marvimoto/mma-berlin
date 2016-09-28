<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKampfpaarung extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kampfpaarung', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('turnier_id')->unsigned();  //ID des zugehörigen Turniers
            $table->integer('red_corner')->unsigned();  //ID des Kämpfers in der roten Ecke
            $table->integer('blue_corner')->unsigned(); //ID des Kämpfers in der blauen Ecke
            $table->text('rules');                      //Regeln (MMA, K-1,...)
            $table->integer('weight');                  //Gewichtslimit
            $table->timestamps();

            $table->foreign('turnier_id')->references('id')->on('turnier');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('kampfpaarung');
    }
}
