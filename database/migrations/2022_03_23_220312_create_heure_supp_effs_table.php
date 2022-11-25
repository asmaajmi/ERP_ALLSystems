<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHeureSuppEffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('heure_supp_effs', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->autoIncrement();
            $table->date('dt_heure_supp');
            $table->time('hr_debut');
            $table->time('hr_fin');
            $table->float('prix');
            $table->string('validation')->nullable();
            $table->unsignedBigInteger('id_emp');
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
        Schema::dropIfExists('heure_supp_effs');
    }
}
