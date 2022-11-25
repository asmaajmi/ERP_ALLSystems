<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdreTravailMesureTypeMesuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordre_travail_mesure_type_mesures', function (Blueprint $table) {
            $table->string('IDOrdreTravailMesure');
            $table->string('DesTypeMesure');
            $table->timestamps();
            $table->foreign('IDOrdreTravailMesure')->references('IDOrdreTravailMesure')->on('ordre_de_travail_de_mesures')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('DesTypeMesure')->references('DesTypeMesure')->on('type_mesures')->onUpdate('cascade')->onDelete('cascade');
            $table->primary(array('IDOrdreTravailMesure','DesTypeMesure'));
          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("ordre_travail_mesure_type_mesures",function(Blueprint $table)
        {
             $table->dropConstrainedForeignId('DesTypeMesure');
             $table->dropConstrainedForeignId('IDOrdreTravailMesure');
        });
        Schema::dropIfExists('ordre_travail_mesure_type_mesures');
    }
}
