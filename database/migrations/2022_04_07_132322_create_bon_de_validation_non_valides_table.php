<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBonDeValidationNonValidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bon_de_validation_non_valides', function (Blueprint $table) {
            $table->string('IDBVNV')->primary();
            $table->string('IDBonValidation');
            $table->foreign('IDBonValidation')->references('IDBV')->on('bon_de_validations')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::table("bon_de_validation_non_valides",function(Blueprint $table)
        {
             $table->dropConstrainedForeignId("IDBonValidation");
        });
        Schema::dropIfExists('bon_de_validation_non_valides');
    }
}
