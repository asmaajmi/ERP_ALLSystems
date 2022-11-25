<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMethodeValidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('methode_valides', function (Blueprint $table) {
            $table->float('TolérenceSup');
            $table->float('TolérenceInf');
            $table->string('GenrePrelevement');
            $table->integer('NbrPrelevement');
            $table->float('PeriodePrelevement');
            $table->float('TailleEchantillon');
            $table->string('IDBVV');
            $table->string('IDOrdreTravailMesure');
            $table->foreign('IDBVV')->references('IDBVV')->on('bon_de_validation_valides')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('IDOrdreTravailMesure')->references('IDOrdreTravailMesure')->on('ordre_de_travail_de_mesures');
            $table->primary(array('IDBVV','IDOrdreTravailMesure'));
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
        Schema::table("methode_valides",function(Blueprint $table)
        {
             $table->dropConstrainedForeignId("IDBVV");
             $table->dropConstrainedForeignId("IDOrdreTravailMesure");
        });
        Schema::dropIfExists('methode_valides');
        
    }
}
