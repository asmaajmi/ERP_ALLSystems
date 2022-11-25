<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdreTravailMesureAvoirParametreMesuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordre_travail_mesure_avoir_parametre_mesures', function (Blueprint $table) {
            $table->string('DesTypeOutil');
            $table->string('DesParametreMesure');
            $table->string('DesPrecision');
            $table->foreign(array('DesTypeOutil', 'DesParametreMesure','DesPrecision'))->references(array('DesTypeOutil', 'DesParametreMesure','DesPrecision'))->on('avoir_parametre_mesure')->onUpdate('cascade')->onDelete('cascade');
            $table->string('IDOrdreTravailMesure');
            $table->foreign('IDOrdreTravailMesure')->references('IDOrdreTravailMesure')->on('ordre_de_travail_de_mesures')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
            $table->primary(array('IDOrdreTravailMesure','DesTypeOutil', 'DesParametreMesure','DesPrecision'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("ordre_travail_mesure_avoir_parametre_mesures",function(Blueprint $table)
        {
             $table->dropConstrainedForeignId(array('DesTypeOutil', 'DesParametreMesure','DesPrecision'));
             $table->dropConstrainedForeignId('IDOrdreTravailMesure');
        });
        Schema::dropIfExists('ordre_travail_mesure_avoir_parametre_mesures');
    }
}
