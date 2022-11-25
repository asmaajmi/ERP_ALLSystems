<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMethodeNonValideQuantitativeVariablePhysiquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('methode_non_valide_quantitative_variable_physiques', function (Blueprint $table) {
            $table->float('TolérenceSup');
            $table->float('TolérenceInf');
            $table->string('GenrePrelevement');
            $table->integer('NbrPrelevement');
            $table->string('IDBVNV');
            $table->string('IDOrdreTravailMesure');
            $table->foreign('IDBVNV')->references('IDBVNV')->on('bon_de_validation_non_valides')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('IDOrdreTravailMesure')->references('IDOrdreTravailMesure')->on('ordre_de_travail_de_mesures');
            $table->primary(array('IDBVNV', 'IDOrdreTravailMesure'));
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
        Schema::table("methode_non_valide_quantitative_variable_physiques",function(Blueprint $table)
        {
             $table->dropConstrainedForeignId("IDBVNV");
             $table->dropConstrainedForeignId("IDOrdreTravailMesure");
        });
        Schema::dropIfExists('methode_non_valide_quantitative_variable_physiques');
    }
}
