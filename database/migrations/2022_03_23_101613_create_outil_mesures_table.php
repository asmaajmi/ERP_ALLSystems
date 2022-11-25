<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutilMesuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outil_mesures', function (Blueprint $table) {
            $table->string("DesOutilMesure")->primary();
            $table->string("NumFicheAchat");
            $table->string('DesTypeOutil');
            $table->string('NomFabriquant');
            $table->boolean('Disponibilite');
            $table->timestamps();
            $table->foreign('DesTypeOutil')->references('DesTypeOutil')->on('type_outils')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('NomFabriquant')->references('NomFabriquant')->on('fabriquants')->onUpdate('cascade')->onDelete('cascade');
   
          
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
        Schema::table("outil_mesures",function(Blueprint $table)
        {
             $table->dropConstrainedForeignId("DesTypeOutil");
             $table->dropConstrainedForeignId("NomFabriquant");
        });
        Schema::dropIfExists('outil_mesures');
    }
}
