<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompteRendusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compte_rendus', function (Blueprint $table) {
            $table->string("IDCR")->primary();
            $table->date('DateCR');
            $table->integer("TotaleControler");
            $table->integer("SommeDefautsTotale");
            $table->float("Pourcentage_defaut_reel");
            $table->float('Cm_mesure');
            $table->float('Cmk_mesure');
            $table->text('Description');
            $table->string('IDFC');
            $table->unsignedBigInteger('IDOperateurCalcul');
            $table->foreign('IDOperateurCalcul')->references('id')->on('operateur_qualite_calculs');
            $table->foreign('IDFC')->references('IDFC')->on('fiche_de_controles')->onUpdate('cascade');
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
        Schema::table("compte_rendus",function(Blueprint $table)
        {
             $table->dropConstrainedForeignId("IDFC");
             $table->dropConstrainedForeignId("IDOperateurCalcul");
            
        });
        Schema::dropIfExists('compte_rendus');
    }
}
