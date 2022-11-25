<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMesureCarteUSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mesure_carte_u_s', function (Blueprint $table) {
            $table->id();
            $table->integer("C");
            $table->integer("TailleEchan");
            $table->integer("U");
            $table->unsignedBigInteger('IDCU');
            $table->foreign('IDCU')->references('id')->on('carte_u_s')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::table("mesure_carte_u_s",function(Blueprint $table)
        {
             $table->dropConstrainedForeignId("IDCU"); 
        });
        Schema::dropIfExists('mesure_carte_u_s');
    }
}
