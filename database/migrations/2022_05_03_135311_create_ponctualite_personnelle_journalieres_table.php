<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePonctualitePersonnelleJournalieresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ponctualite_personnelle_journalieres', function (Blueprint $table) {
            $table->id();
            $table->year('annee');
            $table->integer('mois');
            $table->integer('jour');
            $table->string('des_jour');
            $table->date('date_jour');
            $table->float('valeur');
            $table->string('mention');
            $table->unsignedBigInteger('id_emp');
            $table->foreign('id_emp')->references('id')->on('employes')->onDelete('cascade');
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
        Schema::dropIfExists('ponctualite_personnelle_journalieres');
    }
}
