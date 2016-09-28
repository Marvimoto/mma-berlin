<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProbetrainingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('probetraining', function(Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->text('vorname');
            $table->date('geburtsdatum');
            $table->text('telefon');
            $table->text('ip');
            $table->text('text')->nullable();
            $table->date('datum');
            $table->integer('kurs_id')->unsigned();

            $table->foreign('kurs_id')->references('id')->on('kursplan');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('probetraining');
    }
}
