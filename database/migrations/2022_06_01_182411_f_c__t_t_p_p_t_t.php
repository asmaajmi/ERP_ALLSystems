<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FCTTPPTT extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fcinformation', function (Blueprint $table) {
            $table->string('FC');
            $table->string('DesParametreMesure');
            $table->string('DesPrecision');
            $table->string("enregistrement");
            $table->foreign('FC')->references('IDFC')->on('fiche_de_controles')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('DesParametreMesure')->references('DesParametreMesure')->on('parametre_mesures')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('DesPrecision')->references('DesPrecision')->on('precisions')->onUpdate('cascade')->onDelete('cascade');
            $table->primary(array('FC', 'DesParametreMesure','DesPrecision'));
            $table->string("TypeMesure");
            $table->string("TypeOutil");
            $table->integer("tolinf")->nullable();
            $table->integer("tolsup")->nullable();
           
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
        Schema::table("fcinformation",function(Blueprint $table)
        {
             $table->dropConstrainedForeignId("FC"); 
             $table->dropConstrainedForeignId("DesParametreMesure"); 
             $table->dropConstrainedForeignId("DesPrecision"); 

        });
        Schema::dropIfExists('fcinformation');
    }
}
