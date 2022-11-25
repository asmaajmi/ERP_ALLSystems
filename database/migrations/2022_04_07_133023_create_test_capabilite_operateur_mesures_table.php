<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestCapabiliteOperateurMesuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_capabilite_operateur_mesures', function (Blueprint $table) {
        
            $table->unsignedBigInteger('IDTestCapabilite');
            $table->unsignedBigInteger('IDOperateurMesure');
            $table->foreign('IDTestCapabilite')->references('id')->on('test_capabilites')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('IDOperateurMesure')->references('id')->on('operateur_qualite_mesures');
            $table->primary(array('IDTestCapabilite', 'IDOperateurMesure'));
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
        Schema::table("test_capabilite_operateur_mesures",function(Blueprint $table)
        {
             $table->dropConstrainedForeignId("IDTestCapabilite");
             $table->dropConstrainedForeignId("IDOperateurMesure");
        });
        Schema::dropIfExists('test_capabilite_operateur_mesures');
    }
}
