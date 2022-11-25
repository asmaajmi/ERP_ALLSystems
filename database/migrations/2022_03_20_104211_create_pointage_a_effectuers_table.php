<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePointageAEffectuersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pointage_a_effectuers', function (Blueprint $table) {
            $table->id();
            $table->string('designation_periode',50);
            $table->date('date_debut_periode');
            $table->date('date_fin_periode');
            $table->year('annee');
            $table->integer('mois');
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
        Schema::dropIfExists('pointage_a_effectuers');
    }
}
