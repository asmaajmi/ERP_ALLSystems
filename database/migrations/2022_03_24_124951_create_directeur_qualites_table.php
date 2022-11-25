<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDirecteurQualitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('directeur_qualites', function (Blueprint $table) {
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
        Schema::table("directeur_qualites",function(Blueprint $table)
        {
             $table->dropConstrainedForeignId("IDEmploye");
        });
        Schema::dropIfExists('directeur_qualites');
    }
}
