<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
class CreateAvoirParametreMesureTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avoir_parametre_mesure', function (Blueprint $table) {
          
            $table->string('DesTypeOutil');
            $table->string('DesParametreMesure');
            $table->string('DesPrecision');
            $table->timestamps();
            $table->foreign('DesTypeOutil')->references('DesTypeOutil')->on('type_outils')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('DesParametreMesure')->references('DesParametreMesure')->on('parametre_mesures')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('DesPrecision')->references('DesPrecision')->on('precisions')->onUpdate('cascade')->onDelete('cascade');
            $table->primary(array('DesTypeOutil', 'DesParametreMesure','DesPrecision'));
         
        });
        Schema::enableForeignKeyConstraints();
           
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("avoir_parametre_mesure",function(Blueprint $table)
        {
             $table->dropConstrainedForeignId("DesTypeOutil");
             $table->dropConstrainedForeignId("DesParametreMesure");
             $table->dropConstrainedForeignId("DesPrecision");
        });
        Schema::dropIfExists('avoir_parametre_mesure');
    }
}
