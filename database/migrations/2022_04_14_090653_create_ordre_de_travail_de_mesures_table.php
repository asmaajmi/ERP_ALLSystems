<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdreDeTravailDeMesuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordre_de_travail_de_mesures', function (Blueprint $table) {
            $table->string('IDOrdreTravailMesure')->primary();
            $table->date('Date');
            $table->text('Description');
            $table->unsignedBigInteger('IDOperateurMesure');
            $table->string('IDMachine')->nullable();
            $table->unsignedBigInteger('IDDirecteur');
            $table->string('DesProduit');
            $table->string('IDOT');
            $table->string('Etat');
            $table->foreign('IDOT')->references('IDOT')->on('ordre_travails')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('IDOperateurMesure')->references('id')->on('operateur_qualite_mesures')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('IDMachine')->references('DesMachine')->on('machines')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('IDDirecteur')->references('id')->on('directeur_qualites');
            $table->foreign('DesProduit')->references('DesProduit')->on('produits')->onUpdate('cascade')->onDelete('cascade');
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
             $table->dropConstrainedForeignId("IDMachine");
             $table->dropConstrainedForeignId("IDOperateurMesure");
             $table->dropConstrainedForeignId("IDDirecteur");
             $table->dropConstrainedForeignId("DesProduit");
        });
        Schema::dropIfExists('ordre_de_travail_de_mesures');
    }
}
