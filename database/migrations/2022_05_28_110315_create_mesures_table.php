<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMesuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mesures', function (Blueprint $table) {
            $table->id();
            $table->float("valeur_mesure");
            $table->unsignedBigInteger('IDCM');
            $table->foreign('IDCM')->references('id')->on('colonne_mesures')->onUpdate('cascade')->onDelete('cascade');
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
      
        Schema::table("mesures",function(Blueprint $table)
        {
             $table->dropConstrainedForeignId("IDCM"); 
        });
        Schema::dropIfExists('mesures');
    }
}
