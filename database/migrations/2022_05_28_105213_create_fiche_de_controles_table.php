<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFicheDeControlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fiche_de_controles', function (Blueprint $table) {
            $table->string("IDFC")->primary();
            $table->date('DateFC');
            $table->integer("Totale_a_Controler");
            $table->float("Pourcentage_defaut_estime");
            $table->integer("NombreDeMesure");
            $table->integer("Taille_Echantillon");
            $table->float('Cm_propose');
            $table->float('Cmk_propose');
            $table->string('IDOTMNV');
            $table->foreign('IDOTMNV')->references('IDOTMesureNonValide')->on('o_t_mesure_non_valides')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::table("fiche_de_controles",function(Blueprint $table)
        {
             $table->dropConstrainedForeignId("IDOTMNV");
            
        });
        Schema::dropIfExists('fiche_de_controles');
       
      
    }
}
