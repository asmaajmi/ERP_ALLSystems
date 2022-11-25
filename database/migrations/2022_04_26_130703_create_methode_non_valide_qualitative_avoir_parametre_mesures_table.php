<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMethodeNonValideQualitativeAvoirParametreMesuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('methode_non_valide_qualitative_avoir_parametre_mesures', function (Blueprint $table) {
            $table->string('DTO');
            $table->string('DPM');
            $table->string('DP');
            $table->string('IDBVNV');
            $table->string('IDOTM');
            $table->string('DesT');
            $table->foreign('DTO')->references('DesTypeOutil')->on('type_outils')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('DPM')->references('DesParametreMesure')->on('parametre_mesures')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('DP')->references('DesPrecision')->on('precisions')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(array('IDBVNV', 'IDOTM'))->references(array('IDBVNV', 'IDOrdreTravailMesure'))->on('methode_non_valide_qualitatives');
            $table->foreign('DesT')->references('DesTesteur')->on('certifications')->onUpdate('cascade')->onDelete('cascade');
            $table->primary(array('DTO', 'DPM','DP','IDBVNV', 'IDOTM','DesT'));
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
        Schema::table("methode_non_valide_qualitative_avoir_parametre_mesures",function(Blueprint $table)
        {
             $table->dropConstrainedForeignId('DesTesteur');
             $table->dropConstrainedForeignId('DesTypeOutil');
             $table->dropConstrainedForeignId('DesParametreMesure');
             $table->dropConstrainedForeignId('DesPrecision');
             $table->dropConstrainedForeignId(array('IDBVNV','IDOTM'));
        });
        Schema::dropIfExists('methode_non_valide_qualitative_avoir_parametre_mesures');
    }
}
