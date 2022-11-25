<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarteDeControlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carte_de_controles', function (Blueprint $table) {
            $table->id();
            $table->float('Limite_Sup');
            $table->float('Limite_Inf');
            $table->string('IDOTMV');
            $table->string('Parametre');
            $table->foreign('IDOTMV')->references('IDOTMesureValide')->on('o_t_mesure_valides')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::table("carte_de_controles",function(Blueprint $table)
        {
             $table->dropConstrainedForeignId("IDOTMV"); 
        });
        Schema::dropIfExists('carte_de_controles');
    }
}
