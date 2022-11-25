<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarteMesureMoyenneEtenduesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carte_mesure_moyenne_etendues', function (Blueprint $table) {
            $table->id();
            $table->float('CoefA2');
            $table->float('CoefD4');
            $table->unsignedBigInteger('IDCC');
            $table->foreign('IDCC')->references('id')->on('carte_de_controles')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::table("carte_mesure_moyenne_etendues",function(Blueprint $table)
        {
             $table->dropConstrainedForeignId("IDCC"); 
        });
        Schema::dropIfExists('carte_mesure_moyenne_etendues');
    }
}
