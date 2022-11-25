<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduitAchetablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produit_achetables', function (Blueprint $table) {
            $table->string('DesProduitA')->primary();
            $table->string('DesProduit');
            $table->string('nom_produit');
            $table->string('type_prod');
            $table->timestamps();
            $table->foreign('DesProduit')->references('DesProduit')->on('produits')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::table("produit_achetables",function(Blueprint $table)
        {
             $table->dropConstrainedForeignId("DesProduit");
        });
        Schema::dropIfExists('produit_achetables');
    }
}
