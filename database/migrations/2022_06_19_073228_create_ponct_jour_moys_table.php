<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePonctJourMoysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ponct_jour_moys', function (Blueprint $table) {
                $table->id();
                $table->year('annee');
                $table->integer('mois');
                $table->string('des_jour');
                $table->float('valeur');
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
        Schema::dropIfExists('ponct_jour_moys');
    }
}
