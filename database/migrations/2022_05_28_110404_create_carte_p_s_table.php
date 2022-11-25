<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartePSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carte_p_s', function (Blueprint $table) {
            $table->id();
            $table->float('Pbar');
            $table->unsignedBigInteger('IDCC');
            $table->foreign('IDCC')->references('id')->on('carte_de_controles')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::table("carte_p_s",function(Blueprint $table)
        {
             $table->dropConstrainedForeignId("IDCC"); 
        });
        Schema::dropIfExists('carte_p_s');
    }
}
