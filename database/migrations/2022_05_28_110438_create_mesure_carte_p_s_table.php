<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMesureCartePSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mesure_carte_p_s', function (Blueprint $table) {
            $table->id();
            $table->integer("D");
            $table->integer("Taille_echantillon");
            $table->float("P");
            $table->unsignedBigInteger('IDCP');
            $table->foreign('IDCP')->references('id')->on('carte_p_s')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::table("mesure_carte_p_s",function(Blueprint $table)
        {
             $table->dropConstrainedForeignId("IDCP"); 
        });
        Schema::dropIfExists('mesure_carte_p_s');
    }
}
