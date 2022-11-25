<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConstituerParsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('constituer_pars', function (Blueprint $table) {
            $table->id();
            $table->float('quantite');
            $table->string('unite');
            $table->integer('arrondi')->nullable();
            $table->string('id_prodachetable')->nullable();
            $table->foreign('id_prodachetable')->references('DesProduitA')->on('produit_achetables')->onDelete('cascade');

            $table->string('id_prodconstruisable')->nullable();
            $table->foreign('id_prodconstruisable')->references('DesProduitC')->on('produit_construisables');
           
            $table->unsignedBigInteger('id_nomenclature');
            $table->foreign('id_nomenclature')->references('id')->on('nomenclatures');
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
        Schema::dropIfExists('constituer_pars');
    }
}
