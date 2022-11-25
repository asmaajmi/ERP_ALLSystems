<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColonneMesuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colonne_mesures', function (Blueprint $table) {
            $table->id();
            $table->float("Moyenne");
            $table->float("Etendue");
            $table->float('Xdbar');
            $table->float('Rbar');
            $table->date("date");
            $table->time("heure");
            $table->string("lot");
            $table->unsignedBigInteger("operateur");       
            $table->unsignedBigInteger('IDCM_ME');
            $table->foreign('IDCM_ME')->references('id')->on('carte_mesure_moyenne_etendues')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('operateur')->references('id')->on('operateurs');
     
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
        Schema::table("colonne_mesures",function(Blueprint $table)
        {
             $table->dropConstrainedForeignId("IDCM_ME"); 
        });
        Schema::dropIfExists('colonne_mesures');
    }
}
