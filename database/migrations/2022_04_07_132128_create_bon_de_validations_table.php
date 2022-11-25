<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBonDeValidationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bon_de_validations', function (Blueprint $table) {
            $table->string('IDBV')->primary();
            $table->date('DateValidation');
            $table->string('TypeDuTest');
            $table->string('Etat');
            $table->boolean('ValidationOrdreTravail');
            $table->string('ValidationBonValidation');
            $table->string('IDOrdreTravailTestValidation');
            $table->foreign('IDOrdreTravailTestValidation')->references('IDOTTV')->on('ordre_travail_test_validations')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::table("bon_de_validations",function(Blueprint $table)
        {
             $table->dropConstrainedForeignId("IDOrdreTravailTestValidation");
        });
       
        Schema::dropIfExists('bon_de_validations');
    }
}
