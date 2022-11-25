<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduitConstruisablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produit_construisables', function (Blueprint $table) {
            $table->string('DesProduitC')->primary();
            $table->string('DesProduit');
            $table->string('nom_produit_const');
            $table->string('code_barre');
            $table->integer('lot_optimal');
            $table->string('type_produit');
            $table->string('Nature_produit');
            $table->string('Prix_unit_vente')->nullable();
            $table->unsignedBigInteger('id_nomenclature')->nullable();
            $table->foreign('id_nomenclature')->references('id')->on('nomenclatures')->onDelete('cascade');
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
        Schema::table("produit_construisables",function(Blueprint $table)
        {
             $table->dropConstrainedForeignId("DesProduit");
        });
        Schema::dropIfExists('produit_construisables');
      

    }
}
