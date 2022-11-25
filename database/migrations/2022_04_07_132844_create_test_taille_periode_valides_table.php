<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestTaillePeriodeValidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_taille_periode_valides', function (Blueprint $table) {
            $table->id();
            $table->float('Taille');
            $table->float('Periode');
            $table->unsignedBigInteger('IDTestTaillePeriode');
            $table->timestamps();
            $table->foreign('IDTestTaillePeriode')->references('id')->on('test_taille_periodes')->onUpdate('cascade')->onDelete('cascade');
 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("test_taille_periode_valides",function(Blueprint $table)
        {
             $table->dropConstrainedForeignId("IDTestTaillePeriode");
  
        });
        Schema::dropIfExists('test_taille_periode_valides');
    }
}
