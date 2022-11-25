<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaillePeriodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taille_periodes', function (Blueprint $table) {
            $table->id();
            $table->float('TailleMinimale');
            $table->float('TailleMaximale');
            $table->float('PeriodeMinimale');
            $table->float('PeriodeMaximale');
            $table->string('IDOrdreTestValidation');
            $table->timestamps();
            $table->foreign('IDOrdreTestValidation')->references('IDOTTV')->on('ordre_travail_test_validations')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::table("taille_periodes",function(Blueprint $table)
        {
             $table->dropConstrainedForeignId("IDOrdreTestValidation");
  
        });
        Schema::dropIfExists('taille_periodes');
    }
}
