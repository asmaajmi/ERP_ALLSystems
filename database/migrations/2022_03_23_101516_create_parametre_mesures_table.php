<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParametreMesuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parametre_mesures', function (Blueprint $table) {
         
            $table->string("DesParametreMesure")->primary();
            $table->string('DesTypeMesure');
            $table->boolean("critere");
            $table->timestamps();
            $table->foreign('DesTypeMesure')->references('DesTypeMesure')->on('type_mesures')->onUpdate('cascade')->onDelete('cascade');
           
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("parametre_mesures",function(Blueprint $table)
        {
             $table->dropConstrainedForeignId("DesTypeMesure");
        });
        Schema::dropIfExists('parametre_mesures');
    }
}
