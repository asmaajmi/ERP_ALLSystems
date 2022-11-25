<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDateAEffectuersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('date_a_effectuers', function (Blueprint $table) {
            $table->id();
            $table->date('dt_a_eff');
            $table->string('des_j');
            $table->integer('num_j');
            $table->year('annee');
            $table->integer('mois');
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
        Schema::dropIfExists('date_a_effectuers');
    }
}
