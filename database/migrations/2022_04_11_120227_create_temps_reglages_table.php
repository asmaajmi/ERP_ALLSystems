<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTempsReglagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temps_reglages', function (Blueprint $table) {
            $table->id();
            $table->string('id_machine');
            $table->string('id_produit_const1');
            $table->string('id_produit_const2');
            $table->integer('temps_reglage');
            $table->foreign('id_machine')->references('DesMachine')->on('machines')->onDelete('cascade');
            $table->foreign('id_produit_const1')->references('DesProduitC')->on('produit_construisables')->onDelete('cascade');
            $table->foreign('id_produit_const2')->references('DesProduitC')->on('produit_construisables');
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
        Schema::dropIfExists('temps_reglages');
    }
}
