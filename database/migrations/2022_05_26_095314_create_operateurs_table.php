<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperateursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operateurs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('IDEmploye');
            $table->foreign('IDEmploye')->references('id')->on('employes')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        Schema::table("operateurs",function(Blueprint $table)
        {
             $table->dropConstrainedForeignId("IDEmploye");
        });
        Schema::dropIfExists('operateurs');
       
    }
}
