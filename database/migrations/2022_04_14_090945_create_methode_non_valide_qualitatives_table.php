<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMethodeNonValideQualitativesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('methode_non_valide_qualitatives', function (Blueprint $table) {
            
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
        Schema::table("avoir_parametre_mesure",function(Blueprint $table)
        {
             $table->dropConstrainedForeignId("IDOrdreTravailMesure");
             $table->dropConstrainedForeignId("IDBVNV");
        });
        Schema::dropIfExists('methode_non_valide_qualitatives');
    }
}
