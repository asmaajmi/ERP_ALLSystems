<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProbabilitePresenceAnnuellesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('probabilite_presence_annuelles', function (Blueprint $table) {
            $table->id();
            $table->year('annee');
            $table->unsignedBigInteger('id_emp');
            $table->float('valeur');
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
        Schema::dropIfExists('probabilite_presence_annuelles');
    }
}
