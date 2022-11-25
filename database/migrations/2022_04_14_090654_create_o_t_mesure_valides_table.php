<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOTMesureValidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('o_t_mesure_valides', function (Blueprint $table) {
            $table->string('IDOTMesureValide')->primary();
            $table->string('IDOTM');
            $table->foreign('IDOTM')->references('IDOrdreTravailMesure')->on('ordre_de_travail_de_mesures')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::table("o_t_mesure_valides",function(Blueprint $table)
        {
             $table->dropConstrainedForeignId("IDOTM");
        });
        Schema::dropIfExists('o_t_mesure_valides');
    }
}
