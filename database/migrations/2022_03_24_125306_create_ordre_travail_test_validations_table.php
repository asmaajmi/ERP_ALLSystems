<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdreTravailTestValidationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordre_travail_test_validations', function (Blueprint $table) {
            $table->string('IDOTTV')->primary();
            $table->date('DateOrdreTestValidation');
            $table->string('Objectif');
            $table->text('Description');
            $table->unsignedBigInteger('IDResponsable');
            $table->unsignedBigInteger('IDDirecteur');
            $table->string('IDMachine')->nullable();
            $table->string('DesProduit');
            $table->string('DesTypeOutil');
            $table->string('DesParametreMesure');
            $table->string('DesPrecision');
            $table->string('DesTypeMesure');
            $table->string('Etat');
            $table->string('IDOT');
            $table->timestamps();
            $table->foreign('IDOT')->references('IDOT')->on('ordre_travails')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('IDResponsable')->references('id')->on('responsable_qualites')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('IDDirecteur')->references('id')->on('directeur_qualites');
            $table->foreign('IDMachine')->references('DesMachine')->on('machines')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('DesProduit')->references('DesProduit')->on('produits')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(array('DesTypeOutil', 'DesParametreMesure','DesPrecision'))->references(array('DesTypeOutil', 'DesParametreMesure','DesPrecision'))->on('avoir_parametre_mesure')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('DesTypeMesure')->references('DesTypeMesure')->on('type_mesures');
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("ordre_travail_test_validations",function(Blueprint $table)
        {
             $table->dropConstrainedForeignId("IDResponsable");
             $table->dropConstrainedForeignId("IDDirecteur");
             $table->dropConstrainedForeignId("IDMachine");
             $table->dropConstrainedForeignId("DesProduit");
             $table->dropConstrainedForeignId(array('DesTypeOutil', 'DesParametreMesure','DesPrecision'));
             $table->dropConstrainedForeignId("DesTypeMesure");
        });
        Schema::dropIfExists('ordre_travail_test_validations');
    }
}
