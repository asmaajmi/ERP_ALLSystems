<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperateurQualiteCalculsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operateur_qualite_calculs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('IDEmploye');
            $table->timestamps();
            $table->foreign('IDEmploye')->references('id')->on('employes')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::table("operateur_qualite_calculs",function(Blueprint $table)
        {
             $table->dropConstrainedForeignId("IDEmploye");
        });
        Schema::dropIfExists('operateur_qualite_calculs');
    }
}
