<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuivieDesDrebus1sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suivie_des_drebus1s', function (Blueprint $table) {
            $table->string('IDCR');
            $table->string('DesParametreMesure');
            $table->string('Ncaisse');
            $table->string('Remarque');
            $table->integer('Nbr_Pieces');
            $table->foreign('Ncaisse')->references('Ncaisse')->on('caisses')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(array('IDCR', 'DesParametreMesure'))->references(array('IDCR', 'DesParametreMesure'))->on('suivie_des_rebuts')->onUpdate('cascade')->onDelete('cascade');
            $table->primary(array('IDCR', 'DesParametreMesure','Ncaisse'));
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
    Schema::table("suivie_des_drebus1s",function(Blueprint $table)
    {
         $table->dropConstrainedForeignId(array('IDCR', 'DesParametreMesure'));
         $table->dropConstrainedForeignId("Ncaisse");
    });
  
    Schema::dropIfExists('suivie_des_drebus1s');
    }
       
}
