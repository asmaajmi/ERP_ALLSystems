<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCongePlanifiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conge_planifies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_emp');
            $table->date('date_debut_conge');
            $table->date('date_fin_conge');
            $table->string('designation_conge');
            $table->boolean('payement_conge');
            $table->boolean('validation_conge');
            $table->unsignedBigInteger('nbre_jours_nonpayés')->nullable();
            $table->unsignedBigInteger('nbre_jours_payés')->nullable();
            $table->year('annee');
            $table->integer('mois');
            $table->integer('mois_fin');
            $table->integer('jour_conge_autre_mois')->nullable();
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
        Schema::dropIfExists('conge_planifies');
    }
}
