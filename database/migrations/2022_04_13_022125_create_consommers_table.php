<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsommersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consommers', function (Blueprint $table) {
            $table->id();

            $table->string('id_machine');           
            $table->foreign('id_machine')->references('DesMachine')->on('machines')->onDelete('cascade');

            $table->string('id_produit');
            $table->foreign('id_produit')->references('DesProduitC')->on('produit_construisables')->onDelete('cascade');
            $table->float('quantiteproduit');
            $table->string('uniteproduit');

            $table->unsignedBigInteger('ref_outil');
            $table->foreign('ref_outil')->references('id')->on('outil_fabrications')->onDelete('cascade');
            $table->float('quantiteoutil');
            $table->string('uniteoutil');
            
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
        Schema::dropIfExists('consommers');
    }
}
