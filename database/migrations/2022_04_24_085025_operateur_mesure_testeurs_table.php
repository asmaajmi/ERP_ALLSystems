<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OperateurMesureTesteursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        Schema::create('operateur_mesure_testeurs', function (Blueprint $table) {
        $table->unsignedBigInteger('IDOperateurMesure');
            $table->string('DesTesteur');
            $table->timestamps();
            $table->foreign('IDOperateurMesure')->references('id')->on('operateur_qualite_mesures')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('DesTesteur')->references('DesTesteur')->on('certifications')->onUpdate('cascade')->onDelete('cascade');
            $table->primary(array('IDOperateurMesure', 'DesTesteur'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("operateur_mesure_testeurs",function(Blueprint $table)
        {
             $table->dropConstrainedForeignId("IDOperateurMesure");
             $table->dropConstrainedForeignId("DesTesteur");
        });
    }
}
