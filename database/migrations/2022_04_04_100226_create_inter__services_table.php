<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inter__services', function (Blueprint $table) {
            $table->id();
            $table->date('dt_debut_ex_serv');
            $table->date('dt_fin_ex_serv');
            $table->float('cout_par_utilisation');
            $table->unsignedBigInteger('id_emp');
            $table->float('prime_total_a_payer')->nullable();
            $table->foreign('id_emp')->references('id')->on('employes')->onDelete('cascade');
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
        Schema::dropIfExists('inter__services');
    }
}
