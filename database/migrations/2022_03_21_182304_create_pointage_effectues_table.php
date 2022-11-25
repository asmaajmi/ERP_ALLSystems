<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointageEffectuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pointage_effectues', function (Blueprint $table) {
            $table->id();
            $table->date("datepe");
            $table->time("heure_entree");
            $table->time("heure_sortie");
            $table->year('annee');
            $table->integer('mois');
            $table->string('des_j');  
            $table->integer('num_j');
            $table->unsignedBigInteger('id_emp');
            $table->foreign('id_emp')->references('id')->on('employes')->onDelete('cascade');
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
        Schema::dropIfExists('pointage_effectues');
    }
}
