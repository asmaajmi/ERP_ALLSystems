<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDifferenceJourProbasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('difference_jour_probas', function (Blueprint $table) {
            $table->id();
            $table->integer('nbj_desJour');
            $table->integer('diffhr_desJour');
            $table->integer('diffmin_desJour');
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
        Schema::dropIfExists('difference_jour_probas');
    }
}
