<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuivieDesRebutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suivie_des_rebuts', function (Blueprint $table) {
            $table->string('IDCR');
            $table->string('DesParametreMesure');
            $table->float('PourcentagePartielle');  
            $table->date('Date_Encaissement');
            $table->timestamps();
            $table->foreign('IDCR')->references('IDCR')->on('compte_rendus')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('DesParametreMesure')->references('DesParametreMesure')->on('parametre_mesures')->onUpdate('cascade')->onDelete('cascade');
            $table->primary(array('IDCR', 'DesParametreMesure'));
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("suivie_des_rebuts",function(Blueprint $table)
        {
             $table->dropConstrainedForeignId("IDCR");
             $table->dropConstrainedForeignId("DesParametreMesure");

        });
        Schema::dropIfExists('suivie_des_rebuts');
    }
}
