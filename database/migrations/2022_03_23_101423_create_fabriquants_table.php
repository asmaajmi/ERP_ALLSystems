<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFabriquantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fabriquants', function (Blueprint $table) {
          
            $table->string("NomFabriquant")->primary();
            $table->string("AdresseFabriquant");
            $table->string("EmailFabricant")->nullable();
            $table->string("FaxFabricant")->nullable();
            $table->string("Telephone_1Fabriquant")->unique();
            $table->string("Telephone_2Fabriquant")->nullable();
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
        Schema::dropIfExists('fabriquants');
    }
}
