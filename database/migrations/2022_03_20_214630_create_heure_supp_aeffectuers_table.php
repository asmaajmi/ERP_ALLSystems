<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHeureSuppAeffectuersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('heure_supp_aeffectuers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_emp');
            $table->date('dt_heure_supp');
            $table->time('hr_debut');
            $table->time('hr_fin');
            $table->float('prix');
            $table->string('validation')->nullable();
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
        Schema::dropIfExists('heure_supp_aeffectuers');
    }
}
