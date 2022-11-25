<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employes', function (Blueprint $table) {
            $table->id();
            $table->string('cin_emp',8);
            $table->string('nom_emp',30);
            $table->string('prenom_emp',25);
            $table->date('date_naissance_emp');
            $table->string('tel1_emp',12);
            $table->string('tel2_emp',12)->nullable();
            $table->string('mob1_emp',12);
            $table->string('mob2_emp',12)->nullable();
            $table->string('etat_civil_emp',25);
            $table->date('date_recrutement_emp');
            $table->float('salaire_base_emp');
            $table->string('role_emp');
            $table->integer('seuil_conge_maladie');
            $table->integer('seuil_conge_annuel');
            $table->integer('seuil_conge_accidentel');
            $table->integer('var_seuil_conge_maladie')->nullable();;
            $table->integer('var_seuil_conge_annuel')->nullable();;
            $table->integer('var_seuil_conge_accidentel')->nullable();;
            $table->float('salaire_journalier')->nullable();;
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
        Schema::dropIfExists('employes');
    }
}
