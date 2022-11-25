<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDifferenceJoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('difference_jours', function (Blueprint $table) {
            $table->id();
            $table->integer('nbj_lundi');
            $table->integer('diffhr_lundi');
            $table->integer('diffmin_lundi');

            $table->integer('nbj_mardi');
            $table->integer('diffhr_mardi');
            $table->integer('diffmin_mardi');

            $table->integer('nbj_mercredi');
            $table->integer('diffhr_mercredi');
            $table->integer('diffmin_mercredi');

            $table->integer('nbj_jeudi');
            $table->integer('diffhr_jeudi');
            $table->integer('diffmin_jeudi');

            $table->integer('nbj_vendredi');
            $table->integer('diffhr_vendredi');
            $table->integer('diffmin_vendredi');

            $table->integer('nbj_samedi');
            $table->integer('diffhr_samedi');
            $table->integer('diffmin_samedi');

            $table->integer('nbj_dimanche');
            $table->integer('diffhr_dimanche');
            $table->integer('diffmin_dimanche');

            $table->unsignedBigInteger('id_pointaeff');
            $table->foreign('id_pointaeff')->references('id')->on('pointage_a_effectuers')->onDelete('cascade');
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
        Schema::dropIfExists('difference_jours');
    }
}
