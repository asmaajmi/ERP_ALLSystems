<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBonSortieOutilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bon_sortie_outils', function (Blueprint $table) {
            $table->id();
            $table->date('DateSortie');
            $table->string('IDOT');
            $table->unsignedBigInteger('IDResponsable');
            $table->unsignedBigInteger('IDOperateurMesure');
            $table->string('IDOutil');
            $table->foreign('IDOutil')->references('DesOutilMesure')->on('outil_mesures')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('IDOperateurMesure')->references('id')->on('operateur_qualite_mesures')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('IDOT')->references('IDOT')->on('ordre_travails')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('IDResponsable')->references('id')->on('responsable_qualites');
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
        Schema::table("ordre_de_travail_de_mesures",function(Blueprint $table)
        {
             $table->dropConstrainedForeignId("IDOT");
             $table->dropConstrainedForeignId("IDResponsable");
             $table->dropConstrainedForeignId("IDOperateurMesure");
             $table->dropConstrainedForeignId("IDOutil");
        });
        Schema::dropIfExists('bon_sortie_outils');
    }
}
