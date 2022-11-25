<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCapabilitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('capabilites', function (Blueprint $table) {
            $table->id();
            $table->float('CapabiliteMinimale');
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
        Schema::table("capabilites",function(Blueprint $table)
        {
             $table->dropConstrainedForeignId("IDOrdreTestValidation");
  
        });
        Schema::dropIfExists('capabilites');
    }
}
