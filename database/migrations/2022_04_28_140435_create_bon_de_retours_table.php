<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBonDeRetoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bon_de_retours', function (Blueprint $table) {
            $table->id();
            $table->date('DateRetour');
            $table->unsignedBigInteger('IDBS');
            $table->unsignedBigInteger('IDResponsable');
            $table->unsignedBigInteger('IDOperateurMesure');
            $table->string('IDOutil');
            $table->foreign('IDOutil')->references('DesOutilMesure')->on('outil_mesures')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('IDOperateurMesure')->references('id')->on('operateur_qualite_mesures')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('IDBS')->references('id')->on('bon_sortie_outils');
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
        Schema::table("bon_de_retours",function(Blueprint $table)
        {
             $table->dropConstrainedForeignId("IDBS");
             $table->dropConstrainedForeignId("IDResponsable");
             $table->dropConstrainedForeignId("IDOperateurMesure");
             $table->dropConstrainedForeignId("IDOutil");
        });
        Schema::dropIfExists('bon_de_retours');
    }
}
